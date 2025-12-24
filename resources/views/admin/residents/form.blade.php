@extends('admin.layout.header')
@section('styles')
    <style>
        /* =============================
        WIZARD TABS
        ============================= */
        .wizard-tabs-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .wizard-tabs {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
            min-width: max-content;
        }

        .wizard-tabs-wrapper::-webkit-scrollbar {
            display: none;
        }

        .wizard-tab-btn {
            padding: 5px 10px;
            border-radius: 999px;
            background: #f1f3f5;
            border: none;
            font-weight: 400;
            cursor: pointer;
            white-space: nowrap;
            transition: all .2s ease;
        }

        .wizard-tab-btn.active {
            background: #15a362;
            color: #fff;
        }

        /* =============================
        STEP PANELS
        ============================= */
        .step-panel {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            animation: fadeSlide .3s ease;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* =============================
        TABLE MOBILE FIX
        ============================= */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* =============================
        HEADER ACTIONS (MOBILE)
        ============================= */
        .header-actions {
            display: flex;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .header-actions {
                flex-direction: column;
                width: 100%;
            }

            .header-actions .fancy-btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* =============================
        FILTER ROW MOBILE
        ============================= */
        @media (max-width: 768px) {
            .filter-row > div {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* =============================
        TOUCH FRIENDLY
        ============================= */
        @media (max-width: 576px) {
            .form-control,
            .fancy-btn {
                min-height: 44px;
                font-size: 14px;
            }

            .step-panel {
                padding: 15px;
            }
        }
    </style>
@endsection
@section('content')


<div class="app-content pt-5 p-md-3 p-lg-4">
    <div class="container-xl">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('images/resident-placeholder.jpg') }}"
                     class="rounded-circle"
                     width="60" height="60">

                <div>
                    <h4 class="mb-0 fw-bold">Resident Name</h4>
                    <small class="text-muted">Room 101</small>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="fancy-btn fancy-btn-primary">
                    Add Note
                </button>
                <button class="fancy-btn fancy-btn-secondary">
                    Call GP
                </button>
                <button class="fancy-btn fancy-btn-success">
                    Log Care
                </button>
            </div>
        </div>

        {{-- CARD --}}
        <div class="app-card shadow rounded-4">
            <div class="app-card-body p-4">

                {{-- WIZARD TABS --}}
                <div class="wizard-tabs-wrapper mb-4">
                    <div class="wizard-tabs">
                        <button class="wizard-tab-btn active" data-step="1">
                            Daily Care
                        </button>
                        <button class="wizard-tab-btn" data-step="2">
                            Care Plan
                        </button>
                        <button class="wizard-tab-btn" data-step="3">
                            Risk
                        </button>
                        <button class="wizard-tab-btn" data-step="4">
                            Wounds
                        </button>
                        <button class="wizard-tab-btn" data-step="5">
                            Behaviour
                        </button>
                    </div>
                </div>

                <div id="wizardPanels">

                    {{-- STEP 1: DAILY CARE --}}
                    <div class="step-panel" id="step-1">
                        <h5 class="fw-bold mb-3">Daily Care Records</h5>

                        <div class="mb-3 d-flex gap-2 flex-wrap">
                            @foreach(['Personal Care','Meals','Mobility','Toileting'] as $task)
                                <button class="fancy-btn fancy-btn-secondary">
                                    {{ $task }}
                                </button>
                            @endforeach
                        </div>

                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Task</th>
                                    <th>Completed</th>
                                    <th>Staff</th>
                                    <th>Notes</th>
                                    <th>Done</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-11-27</td>
                                    <td>Meals</td>
                                    <td>Yes</td>
                                    <td>AB</td>
                                    <td>Ate all food</td>
                                    <td>
                                        <input type="checkbox">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- STEP 2: CARE PLAN --}}
                    <div class="step-panel d-none" id="step-2">
                        <h5 class="fw-bold mb-3">Care Plan / Support Plan</h5>

                        <p class="text-muted">
                            Resident goals, interventions, and daily support details.
                        </p>

                        <div class="d-flex gap-2 mt-4">
                            <button class="fancy-btn fancy-btn-primary">
                                Edit Plan
                            </button>
                            <button class="fancy-btn fancy-btn-secondary">
                                Add Goal
                            </button>
                            <button class="fancy-btn fancy-btn-success" onclick="window.print()">
                                Print Summary
                            </button>
                        </div>
                    </div>

                    {{-- STEP 3: RISK --}}
                    <div class="step-panel d-none" id="step-3">
                        <h5 class="fw-bold mb-3">Risk Assessments</h5>

                        <div class="d-flex gap-3 mb-3">
                            <span class="badge bg-success">Low</span>
                            <span class="badge bg-warning text-dark">Medium</span>
                            <span class="badge bg-danger">High</span>
                        </div>

                        <button class="fancy-btn fancy-btn-primary mb-2">
                            Add New Risk
                        </button>

                        <p class="text-muted">
                            Last assessment: 2025-11-25 by Staff AB
                        </p>
                    </div>

                    {{-- STEP 4: WOUNDS --}}
                    <div class="step-panel d-none" id="step-4">
                        <h5 class="fw-bold mb-3">Wound / Dressing Records</h5>

                        <button class="fancy-btn fancy-btn-primary mb-3">
                            Add New Entry
                        </button>

                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    <th>Dressing</th>
                                    <th>Notes</th>
                                    <th>Staff</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-11-27</td>
                                    <td>Bruise</td>
                                    <td>Arm</td>
                                    <td>Bandage</td>
                                    <td>Applied antiseptic</td>
                                    <td>CD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- STEP 5: BEHAVIOUR --}}
                    <div class="step-panel d-none" id="step-5">
                        <h5 class="fw-bold mb-3">Behaviour Monitoring</h5>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <select class="form-control">
                                    <option>Type</option>
                                    <option>Aggression</option>
                                    <option>Withdrawal</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Staff">
                            </div>
                            <div class="col-md-3">
                                <button class="fancy-btn fancy-btn-primary w-100">
                                    Add Incident
                                </button>
                            </div>
                        </div>

                        <div class="border rounded p-3 bg-light">
                            <em>Timeline of incidents will appear here…</em>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        const tabs = document.querySelectorAll(".wizard-tab-btn");
        const panels = document.querySelectorAll(".step-panel");

        function showStep(step) {
            // Hide all panels
            panels.forEach(panel => {
                panel.classList.add("d-none");
            });

            // Remove active from all tabs
            tabs.forEach(tab => {
                tab.classList.remove("active");
            });

            // Show selected panel
            const activePanel = document.getElementById(`step-${step}`);
            if (activePanel) {
                activePanel.classList.remove("d-none");
            }

            // Activate selected tab
            const activeTab = document.querySelector(`.wizard-tab-btn[data-step="${step}"]`);
            if (activeTab) {
                activeTab.classList.add("active");
            }
        }

        // Tab click
        tabs.forEach(tab => {
            tab.addEventListener("click", function () {
                const step = this.getAttribute("data-step");
                showStep(step);
            });
        });

        // Init first tab
        showStep(1);

    });
</script>
@endsection

