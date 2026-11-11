<!DOCTYPE html>
<html>

<head>

    <title>Electricity Bill Calculator</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">


    <style>

        body {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }


        .main-card {
            max-width: 650px;
            margin: auto;
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }


        .header {
            background: #198754;
            color: white;
            padding: 25px;
            text-align: center;
        }


        .header h2 {
            font-weight: bold;
        }


        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 12px;
        }


        .calculate-btn {
            border-radius: 10px;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
        }


        .result-card {
            border-radius: 15px;
        }


        .total-box {
            background: #d1e7dd;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
        }


        .total-box h2 {
            color: #198754;
            font-weight: bold;
        }

    </style>

</head>


<body>


<div class="container py-5">


    <!-- Main Card -->

    <div class="card main-card shadow-lg">


        <!-- Header -->

        <div class="header">

            <h2>
                Electricity Bill Calculator
            </h2>

            <p class="mb-0">
                Calculate your monthly electricity bill
            </p>

        </div>


        <!-- Form -->

        <div class="card-body p-4">


            <form method="POST">


                <!-- Customer Name -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Customer Name
                    </label>

                    <input type="text"
                           name="customer_name"
                           class="form-control"
                           placeholder="Enter customer name"
                           required>

                </div>


                <!-- Account Number -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Electricity Account Number
                    </label>

                    <input type="text"
                           name="account_number"
                           class="form-control"
                           placeholder="Enter account number"
                           required>

                </div>


                <!-- Meter Type -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Meter Type
                    </label>

                    <select name="meter_type"
                            class="form-select"
                            required>

                        <option value="">
                            Select meter type
                        </option>

                        <option value="Domestic">
                            Domestic
                        </option>

                        <option value="Commercial">
                            Commercial
                        </option>

                    </select>

                </div>


                <!-- Previous Reading -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Previous Meter Reading
                    </label>

                    <input type="number"
                           name="previous_reading"
                           class="form-control"
                           placeholder="Enter previous reading"
                           min="0"
                           required>

                </div>


                <!-- Current Reading -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Current Meter Reading
                    </label>

                    <input type="number"
                           name="current_reading"
                           class="form-control"
                           placeholder="Enter current reading"
                           min="0"
                           required>

                </div>


                <!-- Button -->

                <div class="d-grid mt-4">

                    <button type="submit"
                            name="calculate"
                            class="btn btn-success calculate-btn">

                        Calculate Electricity Bill

                    </button>

                </div>


            </form>


            <?php

            if (isset($_POST['calculate'])) {


                // Get form values safely

                $customer_name =
                    $_POST['customer_name'] ?? '';

                $account_number =
                    $_POST['account_number'] ?? '';

                $meter_type =
                    $_POST['meter_type'] ?? '';

                $previous_reading =
                    $_POST['previous_reading'] ?? 0;

                $current_reading =
                    $_POST['current_reading'] ?? 0;


                // Convert readings to numbers

                $previous_reading =
                    (float)$previous_reading;

                $current_reading =
                    (float)$current_reading;


                // Check meter readings

                if ($current_reading < $previous_reading) {

                    echo '

                    <div class="alert alert-danger mt-4">

                        Current reading cannot be lower
                        than previous reading.

                    </div>

                    ';

                } else {


                    // Calculate units

                    $units =
                        $current_reading - $previous_reading;


                    // Calculate energy charge

                    if ($units <= 30) {

                        $energy_charge =
                            $units * 10;

                    } elseif ($units <= 90) {

                        $energy_charge =
                            (30 * 10)
                            +
                            (($units - 30) * 20);

                    } else {

                        $energy_charge =
                            (30 * 10)
                            +
                            (60 * 20)
                            +
                            (($units - 90) * 30);

                    }


                    // Fixed charge according to meter type

                    if ($meter_type == "Domestic") {

                        $fixed_charge = 500;

                    } else {

                        $fixed_charge = 1000;

                    }


                    // Total bill

                    $total_bill =
                        $energy_charge
                        +
                        $fixed_charge;


                    ?>


                    <!-- Result -->

                    <div class="card result-card shadow mt-4">


                        <div class="card-header bg-success text-white">

                            <h4 class="mb-0">
                                Electricity Bill Details
                            </h4>

                        </div>


                        <div class="card-body">


                            <!-- Customer -->

                            <div class="alert alert-info">

                                <strong>
                                    Customer Name:
                                </strong>

                                <?php
                                echo htmlspecialchars($customer_name);
                                ?>

                            </div>


                            <!-- Account Number -->

                            <div class="d-flex justify-content-between
                                        border-bottom py-2">

                                <span>
                                    Account Number
                                </span>

                                <strong>

                                    <?php
                                    echo htmlspecialchars($account_number);
                                    ?>

                                </strong>

                            </div>


                            <!-- Meter Type -->

                            <div class="d-flex justify-content-between
                                        border-bottom py-2">

                                <span>
                                    Meter Type
                                </span>

                                <strong>

                                    <?php
                                    echo htmlspecialchars($meter_type);
                                    ?>

                                </strong>

                            </div>


                            <!-- Previous Reading -->

                            <div class="d-flex justify-content-between
                                        border-bottom py-2">

                                <span>
                                    Previous Reading
                                </span>

                                <strong>

                                    <?php
                                    echo $previous_reading;
                                    ?>

                                </strong>

                            </div>


                            <!-- Current Reading -->

                            <div class="d-flex justify-content-between
                                        border-bottom py-2">

                                <span>
                                    Current Reading
                                </span>

                                <strong>

                                    <?php
                                    echo $current_reading;
                                    ?>

                                </strong>

                            </div>


                            <!-- Units -->

                            <div class="d-flex justify-content-between
                                        border-bottom py-2">

                                <span>
                                    Units Used
                                </span>

                                <strong>

                                    <?php
                                    echo $units;
                                    ?>

                                    Units

                                </strong>

                            </div>


                            <!-- Energy Charge -->

                            <div class="d-flex justify-content-between
                                        border-bottom py-2">

                                <span>
                                    Energy Charge
                                </span>

                                <strong>

                                    Rs.

                                    <?php
                                    echo number_format(
                                        $energy_charge,
                                        2
                                    );
                                    ?>

                                </strong>

                            </div>


                            <!-- Fixed Charge -->

                            <div class="d-flex justify-content-between
                                        border-bottom py-2">

                                <span>
                                    Fixed Charge
                                </span>

                                <strong>

                                    Rs.

                                    <?php
                                    echo number_format(
                                        $fixed_charge,
                                        2
                                    );
                                    ?>

                                </strong>

                            </div>


                            <!-- Total -->

                            <div class="total-box mt-4">

                                <p class="mb-1">
                                    Total Electricity Bill
                                </p>

                                <h2>

                                    Rs.

                                    <?php
                                    echo number_format(
                                        $total_bill,
                                        2
                                    );
                                    ?>

                                </h2>

                            </div>


                        </div>

                    </div>


                    <?php

                }

            }

            ?>


        </div>

    </div>

</div>


</body>

</html>