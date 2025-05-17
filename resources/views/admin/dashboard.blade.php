@extends('layouts.admin-master')

@section('content')
<div class="px-6 py-8">
    <div class="grid gap-6 xl:grid-cols-2 2xl:grid-cols-3">
      <!-- Main widget -->
      <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm 2xl:col-span-2 dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between mb-6">
          <div class="flex-shrink-0">
            <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
            <h3 class="mt-1 text-base font-medium text-gray-500 dark:text-gray-400">Sales this week</h3>
          </div>
          <div class="flex items-center justify-end flex-1 text-base font-medium {{ $salesGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} dark:text-green-400">
            {{ number_format($salesGrowth, 1) }}%
            <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                clip-rule="evenodd"></path>
            </svg>
          </div>
        </div>
        <div id="main-chart" class="mt-4"></div>
        <!-- Card Footer -->
        <div class="flex items-center justify-between pt-4 mt-6 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
          <div>
            <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" type="button" data-dropdown-toggle="weekly-sales-dropdown">
              @switch($period)
                @case('today')
                  Today
                  @break
                @case('yesterday')
                  Yesterday
                  @break
                @case('7days')
                  Last 7 days
                  @break
                @case('30days')
                  Last 30 days
                  @break
                @case('90days')
                  Last 90 days
                  @break
                @default
                  Last 7 days
              @endswitch
              <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="weekly-sales-dropdown">
                <div class="px-4 py-3" role="none">
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                    {{ $startDate->format('M d, Y') }} - {{ $endDate->format('M d, Y') }}
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a href="{{ request()->fullUrlWithQuery(['period' => 'yesterday']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white {{ $period === 'yesterday' ? 'bg-gray-100 dark:bg-gray-600' : '' }}" role="menuitem">Yesterday</a>
                  </li>
                  <li>
                    <a href="{{ request()->fullUrlWithQuery(['period' => 'today']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white {{ $period === 'today' ? 'bg-gray-100 dark:bg-gray-600' : '' }}" role="menuitem">Today</a>
                  </li>
                  <li>
                    <a href="{{ request()->fullUrlWithQuery(['period' => '7days']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white {{ $period === '7days' ? 'bg-gray-100 dark:bg-gray-600' : '' }}" role="menuitem">Last 7 days</a>
                  </li>
                  <li>
                    <a href="{{ request()->fullUrlWithQuery(['period' => '30days']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white {{ $period === '30days' ? 'bg-gray-100 dark:bg-gray-600' : '' }}" role="menuitem">Last 30 days</a>
                  </li>
                  <li>
                    <a href="{{ request()->fullUrlWithQuery(['period' => '90days']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white {{ $period === '90days' ? 'bg-gray-100 dark:bg-gray-600' : '' }}" role="menuitem">Last 90 days</a>
                  </li>
                </ul>
                <div class="py-1" role="none">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Custom...</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!--Tabs widget -->
      <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h3 class="flex items-center mb-6 text-xl font-semibold text-gray-900 dark:text-white">
          Statistics this month
          <button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button" class="ml-2 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 transition-colors duration-200">
            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Show information</span>
          </button>
        </h3>
        <div data-popover id="popover-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
          <div class="p-3 space-y-2">
            <h3 class="font-semibold text-gray-900 dark:text-white">Statistics</h3>
            <p>Statistics is a branch of applied mathematics that involves the collection, description, analysis, and inference of conclusions from quantitative data.</p>
            <a href="#" class="flex items-center font-medium text-primary-600 dark:text-primary-500 dark:hover:text-primary-600 hover:text-primary-700">Read more <svg class="w-4 h-4 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></a>
          </div>
          <div data-popper-arrow></div>
        </div>
        <div class="sm:hidden">
          <label for="tabs" class="sr-only">Select tab</label>
          <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option>Statistics</option>
            <option>Services</option>
            <option>FAQ</option>
          </select>
        </div>
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
          <li class="w-full">
            <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600 transition-colors duration-200">
              <div class="flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                Top Products
              </div>
            </button>
          </li>
          <li class="w-full">
            <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600 transition-colors duration-200">
              <div class="flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                </svg>
                Top Customers
              </div>
            </button>
          </li>
        </ul>
        <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
          <div class="hidden pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach($topProducts as $product)
              <li class="py-4">
                <div class="flex items-center justify-between gap-4">
                  <div class="flex items-center min-w-0 flex-1">
                    @php
                      $productImage = $product->image_url ? asset('storage/' . $product->image_url) : asset('images/default-product.png');
                    @endphp
                    <img class="flex-shrink-0 w-12 h-12 rounded-lg object-cover bg-gray-100" 
                         src="{{ $productImage }}" 
                         alt="{{ $product->name }}"
                         onerror="this.onerror=null; this.src='{{ asset('images/default-product.png') }}'">
                    <div class="ml-4 overflow-hidden">
                      <p class="font-medium text-gray-900 truncate dark:text-white">
                        {{ $product->name }}
                      </p>
                      <div class="flex items-center text-sm text-green-500 dark:text-green-400">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                          <path clip-rule="evenodd" fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z"></path>
                        </svg>
                        {{ $product->transaction_items_count }} transactions
                      </div>
                    </div>
                  </div>
                  <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white flex-shrink-0">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach($topCustomers as $customer)
              <li class="py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    @php
                      $userImage = $customer->profile_photo_url ? $customer->profile_photo_url : asset('images/default-avatar.png');
                    @endphp
                    <img class="w-10 h-10 rounded-full bg-gray-100" 
                         src="{{ $userImage }}" 
                         alt="{{ $customer->name }}"
                         onerror="this.onerror=null; this.src='{{ asset('images/default-avatar.png') }}'">
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-900 truncate dark:text-white">
                      {{ $customer->name }}
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                      {{ $customer->email }}
                    </p>
                  </div>
                  <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white flex-shrink-0">
                    Rp {{ number_format($customer->transactions_sum_total_price, 0, ',', '.') }}
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">New products</h3>
              <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $newProducts }}</span>
              <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                <span class="flex items-center mr-1.5 text-sm {{ $productGrowth >= 0 ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z"></path>
                  </svg>
                  {{ $productGrowth }}% 
                </span>
                Last 7 days
              </p>
            </div>
          </div>
          <div id="new-products-chart" class="mt-4"></div>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Users</h3>
              <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $newUsers }}</span>
              <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                <span class="flex items-center mr-1.5 text-sm {{ $userGrowth >= 0 ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z"></path>
                  </svg>
                  {{ $userGrowth }}% 
                </span>
                Last 7 days
              </p>
            </div>
          </div>
          <div id="week-signups-chart" class="mt-4"></div>
        </div>
        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Audience by age</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Demographic distribution of users</p>
            </div>
          </div>
          <div class="space-y-4">
            <div class="flex items-center">
              <div class="w-20 text-sm font-medium text-gray-900 dark:text-white">50+</div>
              <div class="flex-1 h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 mx-4">
                <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $agePercentages['50+'] }}%"></div>
              </div>
              <div class="w-12 text-sm text-right font-medium text-gray-900 dark:text-white">{{ $agePercentages['50+'] }}%</div>
            </div>
            <div class="flex items-center">
              <div class="w-20 text-sm font-medium text-gray-900 dark:text-white">40-49</div>
              <div class="flex-1 h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 mx-4">
                <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $agePercentages['40-49'] }}%"></div>
              </div>
              <div class="w-12 text-sm text-right font-medium text-gray-900 dark:text-white">{{ $agePercentages['40-49'] }}%</div>
            </div>
            <div class="flex items-center">
              <div class="w-20 text-sm font-medium text-gray-900 dark:text-white">30-39</div>
              <div class="flex-1 h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 mx-4">
                <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $agePercentages['30-39'] }}%"></div>
              </div>
              <div class="w-12 text-sm text-right font-medium text-gray-900 dark:text-white">{{ $agePercentages['30-39'] }}%</div>
            </div>
            <div class="flex items-center">
              <div class="w-20 text-sm font-medium text-gray-900 dark:text-white">20-29</div>
              <div class="flex-1 h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 mx-4">
                <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $agePercentages['20-29'] }}%"></div>
              </div>
              <div class="w-12 text-sm text-right font-medium text-gray-900 dark:text-white">{{ $agePercentages['20-29'] }}%</div>
            </div>
            <div class="flex items-center">
              <div class="w-20 text-sm font-medium text-gray-900 dark:text-white">Under 20</div>
              <div class="flex-1 h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 mx-4">
                <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $agePercentages['Under 20'] }}%"></div>
              </div>
              <div class="w-12 text-sm text-right font-medium text-gray-900 dark:text-white">{{ $agePercentages['Under 20'] }}%</div>
            </div>
          </div>
        </div>
      </div>
</div>

@push('scripts')
<script>
    // Format sales data for chart
    const salesData = @json($salesData);
    const chartData = {
        dates: salesData.map(item => item.date),
        totals: salesData.map(item => item.total)
    };

    // Data for new products chart
    const productChartData = @json($productChartData);
    const productChartDates = productChartData.map(item => item.date);
    const productChartTotals = productChartData.map(item => item.total);

    // Data for new users chart
    const userChartData = @json($userChartData);
    const userChartDates = userChartData.map(item => item.date);
    const userChartTotals = userChartData.map(item => item.total);

    // Initialize main chart
    const mainChartOptions = {
        chart: {
            height: 420,
            type: 'area',
            fontFamily: 'Inter, sans-serif',
            foreColor: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280',
            toolbar: {
                show: false
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                enabled: true,
                opacityFrom: document.documentElement.classList.contains('dark') ? 0 : 0.45,
                opacityTo: document.documentElement.classList.contains('dark') ? 0.15 : 0
            }
        },
        dataLabels: {
            enabled: false
        },
        tooltip: {
            style: {
                fontSize: '14px',
                fontFamily: 'Inter, sans-serif',
            },
            y: {
                formatter: function (value) {
                    return 'Rp ' + value.toLocaleString('id-ID');
                }
            }
        },
        grid: {
            show: true,
            borderColor: document.documentElement.classList.contains('dark') ? '#374151' : '#F3F4F6',
            strokeDashArray: 1,
            padding: {
                left: 35,
                bottom: 15
            }
        },
        series: [
            {
                name: 'Revenue',
                data: chartData.totals,
                color: '#1A56DB'
            }
        ],
        markers: {
            size: 5,
            strokeColors: '#ffffff',
            hover: {
                size: undefined,
                sizeOffset: 3
            }
        },
        xaxis: {
            categories: chartData.dates,
            labels: {
                style: {
                    colors: [document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'],
                    fontSize: '14px',
                    fontWeight: 500,
                },
            },
            axisBorder: {
                color: document.documentElement.classList.contains('dark') ? '#374151' : '#F3F4F6',
            },
            axisTicks: {
                color: document.documentElement.classList.contains('dark') ? '#374151' : '#F3F4F6',
            },
            crosshairs: {
                show: true,
                position: 'back',
                stroke: {
                    color: document.documentElement.classList.contains('dark') ? '#374151' : '#F3F4F6',
                    width: 1,
                    dashArray: 10,
                },
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: [document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'],
                    fontSize: '14px',
                    fontWeight: 500,
                },
                formatter: function (value) {
                    return 'Rp ' + value.toLocaleString('id-ID');
                }
            },
        },
        legend: {
            fontSize: '14px',
            fontWeight: 500,
            fontFamily: 'Inter, sans-serif',
            labels: {
                colors: [document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280']
            },
            itemMargin: {
                horizontal: 10
            }
        },
        responsive: [
            {
                breakpoint: 1024,
                options: {
                    xaxis: {
                        labels: {
                            show: false
                        }
                    }
                }
            }
        ]
    };

    // New products line chart
    const newProductsChartOptions = {
        chart: {
            height: 200,
            type: 'line',
            fontFamily: 'Inter, sans-serif',
            foreColor: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280',
            toolbar: {
                show: false
            }
        },
        series: [{
            name: 'New Products',
            data: productChartTotals,
        }],
        xaxis: {
            categories: productChartDates,
            labels: {
                style: {
                    colors: [document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'],
                    fontSize: '12px',
                },
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: [document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'],
                    fontSize: '12px',
                },
            },
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ['#1A56DB']
        },
        colors: ['#1A56DB'],
        grid: {
            show: true,
            borderColor: document.documentElement.classList.contains('dark') ? '#374151' : '#F3F4F6',
            strokeDashArray: 1,
            padding: {
                left: 35,
                bottom: 15
            }
        },
        tooltip: {
            x: { format: 'yyyy-MM-dd' },
            y: {
                formatter: function (val) { return val + ' products'; }
            }
        },
        markers: {
            size: 4,
            strokeColors: '#ffffff',
            hover: {
                size: undefined,
                sizeOffset: 3
            }
        }
    };

    // New users line chart
    const newUsersChartOptions = {
        chart: {
            height: 200,
            type: 'line',
            fontFamily: 'Inter, sans-serif',
            foreColor: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280',
            toolbar: {
                show: false
            }
        },
        series: [{
            name: 'New Users',
            data: userChartTotals,
        }],
        xaxis: {
            categories: userChartDates,
            labels: {
                style: {
                    colors: [document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'],
                    fontSize: '12px',
                },
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: [document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'],
                    fontSize: '12px',
                },
            },
        },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ['#10B981']
        },
        colors: ['#10B981'],
        grid: {
            show: true,
            borderColor: document.documentElement.classList.contains('dark') ? '#374151' : '#F3F4F6',
            strokeDashArray: 1,
            padding: {
                left: 35,
                bottom: 15
            }
        },
        tooltip: {
            x: { format: 'yyyy-MM-dd' },
            y: {
                formatter: function (val) { return val + ' users'; }
            }
        },
        markers: {
            size: 4,
            strokeColors: '#ffffff',
            hover: {
                size: undefined,
                sizeOffset: 3
            }
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        const mainChart = new ApexCharts(document.getElementById('main-chart'), mainChartOptions);
        mainChart.render();

        // New products chart
        const newProductsChart = new ApexCharts(document.getElementById('new-products-chart'), newProductsChartOptions);
        newProductsChart.render();

        // New users chart
        const newUsersChart = new ApexCharts(document.getElementById('week-signups-chart'), newUsersChartOptions);
        newUsersChart.render();

        // Update chart when dark mode changes
        document.addEventListener('dark-mode', function () {
            mainChart.updateOptions(mainChartOptions);
            newProductsChart.updateOptions(newProductsChartOptions);
            newUsersChart.updateOptions(newUsersChartOptions);
        });
    });
</script>
@endpush
@endsection
