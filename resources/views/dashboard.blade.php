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

            // Add bars with colors
            g.selectAll(".bar")
                .data(transactionData)
                .enter().append("rect")
                .attr("class", "bar")
                .attr("x", 0)
                .attr("height", y.bandwidth())
                .attr("width", d => x(d.total))
                .attr("y", d => y(d.country))
                .attr("fill", d => color(d.country)); // Apply color to each bar

            // Add X-axis label
            svg.append("text")
                .attr("x", width / 2)
                .attr("y", height - 10)
                .attr("text-anchor", "middle")
                .text("Country");

            // Add Y-axis label
            svg.append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 10)
                .attr("x", 0 - (height / 2))
                .attr("text-anchor", "middle")
                .text("Total Transactions");
        </script>
    @endpush
</x-app-layout>
