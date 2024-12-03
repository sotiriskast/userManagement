<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Transaction Count by Country</h3>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/d3@7"></script>
        <script>
            const transactionData = @json($transactionData);

            const width = 800;
            const height = 400;
            const margin = { top: 20, right: 20, bottom: 60, left: 180 };

            const svg = d3.select("#chart")
                .append("svg")
                .attr("width", width)
                .attr("height", height);

            const g = svg.append("g")
                .attr("transform", `translate(${margin.left}, ${margin.top})`);

            // Create tooltip div
            const tooltip = d3.select("#chart")
                .append("div")
                .attr("class", "tooltip")
                .style("opacity", 0)
                .style("position", "absolute")
                .style("background-color", "white")
                .style("border", "1px solid #ddd")
                .style("padding", "10px")
                .style("border-radius", "5px")
                .style("pointer-events", "none");

            // Define scales
            const x = d3.scaleLinear()
                .range([0, width - margin.left - margin.right]);

            const y = d3.scaleBand()
                .range([height - margin.bottom, margin.top])
                .padding(0.1);

            // Create a color scale
            const color = d3.scaleOrdinal()
                .domain(transactionData.map(d => d.country))
                .range(d3.schemeCategory10);

            x.domain([0, d3.max(transactionData, d => d.total)]);
            y.domain(transactionData.map(d => d.country));

            // Add X-axis
            g.append("g")
                .attr("transform", `translate(0, ${height - margin.bottom})`)
                .call(d3.axisBottom(x)
                    .tickFormat(d => d.toLocaleString())
                    .tickSize(-height + margin.top + margin.bottom));

            // Add Y-axis
            g.append("g")
                .call(d3.axisLeft(y));

            // Add bars with interactive features
            g.selectAll(".bar")
                .data(transactionData)
                .enter().append("rect")
                .attr("class", "bar")
                .attr("x", 0)
                .attr("height", y.bandwidth())
                .attr("width", d => x(d.total))
                .attr("y", d => y(d.country))
                .attr("fill", d => color(d.country))
                .on("mouseover", function(event, d) {
                    // Highlight bar
                    d3.select(this)
                        .attr("opacity", 0.7);

                    // Show tooltip
                    tooltip.transition()
                        .duration(200)
                        .style("opacity", .9);
                    tooltip.html(`
            <strong>${d.country}</strong><br>
            Total Transactions: ${d.total.toLocaleString()}
        `)
                        .style("left", (event.pageX + 10) + "px")
                        .style("top", (event.pageY - 28) + "px");
                })
                .on("mouseout", function() {
                    // Restore original bar
                    d3.select(this)
                        .attr("opacity", 1);

                    // Hide tooltip
                    tooltip.transition()
                        .duration(500)
                        .style("opacity", 0);
                });

            // Add X-axis label
            svg.append("text")
                .attr("x", width / 2)
                .attr("y", height - 10)
                .attr("text-anchor", "middle")
                .text("Total Transactions");

            // Add Y-axis label
            svg.append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 10)
                .attr("x", 0 - (height / 2))
                .attr("text-anchor", "middle")
                .text("Country");
        </script>
    @endpush
</x-app-layout>
