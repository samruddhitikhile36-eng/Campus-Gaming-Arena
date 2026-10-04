# SECURITY TESTING RECORD

## Test 1 - SQL Injection / Quote Handling

Input:

O'Reilly

Expected result:

The application should accept the input as normal text and should NOT produce a SQL syntax error.

Reason:

Prepared statements are used.

---

## Test 2 - XSS

Input:

<script>alert('XSS')</script>

Expected result:

The script must NOT execute.

The text should be displayed safely as text.

Reason:

Output is escaped using htmlspecialchars().

---

## Test 3 - Invalid Contact Number

Input:

12345

Expected result:

Booking must be rejected.

Reason:

Server-side validation requires exactly 10 digits.

---

## Test 4 - Invalid Duration

Input:

10

Expected result:

Booking must be rejected.

Reason:

The application allows only 1 to 4 hours.

---

## Test 5 - Invalid Station

Input:

Invalid station ID

Expected result:

Booking must be rejected.

Reason:

Station ID is validated server-side and checked against the database.

---

## Test 6 - Duplicate Booking

Same station + same date + same start time.

Expected result:

Second booking is rejected.

Reason:

The application checks for an existing confirmed booking before INSERT.

---

## Test 7 - Unauthorized/Invalid Cancellation ID

Input:

abc

Expected result:

Cancellation must be rejected.

Reason:

Reservation ID is validated using FILTER_VALIDATE_INT.

---

## Security Features Implemented

1. Prepared SQL statements
2. Parameter binding
3. Server-side validation
4. Output escaping
5. Error logging
6. Duplicate booking prevention
7. Integer validation
8. Database foreign key
