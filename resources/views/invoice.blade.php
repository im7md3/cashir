@extends('layouts.app')
@section('content')
        <div class="invoice-content bg-white shadow rounded-3 pb-2">
          <h1 class="invoice-name text-center rounded-3 fw-bold mb-0">
            فاتورة ضريبة مبسطة
            <br>
            #1
          </h1>
          <h4 class="  mb-2 fw-bold mb-3 text-center mt-2">
            عيادة الشفاء
          </h4>
          <div class="the_date d-flex align-items-center justify-content-evenly mb-3">
            <div class="date-holder ">
              <small>2022-10-06</small>
            </div>
            <div class="date-holder ">
              <small>13:01</small>
            </div>
          </div>
          <div class="logo-holder m-auto  rounded-3 mb-3">
            <img class="the_image w-100 h-auto rounded-3" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAACCCAMAAAC93eDPAAAAY1BMVEUAAAD///8cHBze3t7s7OyHh4fBwcFdXV2QkJD6+vqpqamysrKtra3n5+f09PQkJCScnJxLS0syMjLLy8sYGBi4uLjV1dVxcXFVVVU9PT16enpQUFBnZ2eWlpYsLCwICAhERESL8doKAAAEqUlEQVR4nO2Y6bKrKBCA03FF45Ko0az6/k95oRsV0FvlMZk5NTXNj6gIzUdvtDkcfrsdfxuAERiBERiBERiBERiBERiBERiBERiBERiBERiBERjh/4xQj9f+R9O+idBphvpJ17b41xH6WN/cO7xE5T+F8G7CsMEWhqn1JqalDzfdXT1cSZd+fYVbFyShbGkZROe1QTbC8R7cBcjmyxvrzaPRN2GEl9Z3JTVrCi3KqwA/fMXxK/Wk3PyaLtiX83yF4C26Q+0FN1q7zx1TdNllMecRSlGn9/QcqWfIHIjNCFGmb7wXXkrorPcpuNurGymoull9Z6WKYCdC72vLxDlut4ar9V7A055wyaQc26HUeleAu9O1BaFWIfjKdWACuUUFpileruRB+VS4kH6oxS6EMy4GCT0lgB75BBisWZZ+b4rA1pNu7S5DDKB+G0FLRkBu4RmjWjknNqcoK+TnNYTe34egdPcc9XqlfcQwm0JaeFQStkQJOa0RSEdudyA8SKWZdvoWcjXtlgPofXZqTjNPuKhn2JjENyG0tFagu48ZLSeDTkdqBbblQwfpc4Q7+fbF1858AqE8cpi0j3OyaTz6IjnttxBkxOUqxTSQ4fhCb1nlmUHdKOcDMY2P0Q4bCbYhKOdSOfE2OuCVQjAYR3r2mvhYfRVBmTanpVEbyjJCnXlCmwJtD2Ndc8lBM38PAb1NuUEwJjyfQi5VL546BsfwwCSxSMMfIlwnhx8XUmtKfUSCwp+MPx4SAXrGVm/chjCbOtEoZ0E3Ek48MFkbJyDqJLePyO8hdEJruKIl7+R2EQ4YcyV6hl8fNrYtCAXGHPqj2jYG5pN6Ch/D/wFmQka7LaoqRdqkaaJamjZzlt6CcDG6Wu3rvU/bTjEhDbmZDv+K8CjLE8KGZTlXF1sQzvkc50ojQtUsJaBHXjD2sDyZMgEhrFezg+U1mxHQ78c9Jvr2rRfFlWrPPCQQIX8f1tpjHwL5uz6LC9q9Xmi0KD5k2gPRHcVqsbAXobX8vdL7bU2LY/ISWhjaCJyq4DOEO06LzScl3yxPMU2OBUJgjbdbtA+BRE4JVzmnV+NmxVi408a1+cl3VkrX/QgvnDZFES73wqpgOg2JsjNFiMNa24mAsTxtGJMzKj2EwZbcmhMWnzafIDSIMH+vVTpGn/OoG2jVYCOfWy3cdiJQnM/PFKSDlDeLMeNWQ+Zr5etOBM9BOFq5EFsNlgcOVhh/AQHzc2Z0lHaIHPSRYVDReb381t6LIBY9sG4so4z3/hKXnyBYeq8sy0893iztnS2W+gChRwTrM721Q+Sg06P5LwcVGc4H/5jsf4pwsQKOWuZ+MZLxB7MLTys3TVOha/VuQOiW4CphFm4HgPPHS6sUEVrKOivpwrPGbUAg89kqHYTjaqRgp2ruAylMpFMhW5cyuPzSGeX86VeeSFN5cqKojtIEPQ2qJB2MkaEppzsl9DETJqkj/1zK6aJKT6e0yiFr4mWg2ghFEMcBNnklES/dE8cvsyy3aiJz0LJS6YtOvoiD5229qP7v/A3OCIzACIzACIzACIzACL/dGIERGIERGIERGIERGIERGOFnCMffbu8/MuQwx75/L1EAAAAASUVORK5CYII=" alt="logo">
          </div>
         <div class="me-2">
          <div class="tax-number  mb-2 fw-bold">
            <small>{{ __('site.Tax_Number') }} : <span class="">111111111111111</span></small>
          </div>
          <div class="the_address mb-4 fw-bold">
            <div class="address-holder">
              <small>address</small>
            </div>
          </div>
         </div>
          <div class="table-responsive">
            <table class="table main-table text-center rounded-3 w-100">
              <thead class="border-0">
                <tr>

                  <th class="">
                    <div>{{ __('site.Description') }}</div>
                    <div class="">Description</div>
                  </th>

                  <th class="">
                    <div class="">{{ __('site.price') }}</div>
                    <div class="">price</div>
                  </th>

                  <th>
                    <div class="">{{ __('site.Quantity') }}</div>
                    <div class="">Qty</div>
                  </th>
                  <th>
                    <div class="">{{ __('site.Discount') }}</div>
                    <div class="">Dicsc</div>
                  </th>
                  <th>
                    <div class="">{{ __('site.The_Tax') }}</div>
                    <div class="">Vat</div>
                  </th>
                  <th>
                    <div class="">{{ __('site.Total') }}</div>
                    <div class="">Total</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                                <tr>
                  <td>
                    دواء 1
                  </td>
                  <td>
                    10
                  </td>
                  <td>
                    1
                  </td>
                  <td>
                    0
                  </td>
                  <td>
                    2
                  </td>
                  <td>
                    22
                  </td>
                </tr>
                              </tbody>
            </table>
          </div>
          <div class="table-responsive second-table mt-2">
            <table class="table main-table" id="data-table">
              <tbody>
                <tr class="">
                  <td colspan="1" class="text-end ">
                    <div class="text-center spechial-text">{{ __('site.Total') }}</div>
                    <div class="text-center spechial-text">Total</div>
                  </td>
                  <td colspan="3 " class="">22</td>
                </tr>
                <tr>
                  <td colspan="2" class="text-end ">
                    <div class="text-center spechial-text">{{ __('site.Discount') }}</div>
                    <div class="text-center spechial-text">Dicsc</div>
                  </td>
                  <td colspan="2"> 0</td>
                </tr>
                <tr>
                  <td colspan="2" class="text-end ">
                    <div class="text-center spechial-text">{{ __('site.Total_before_discount_and_tax') }}</div>
                    <div class="text-center spechial-text">Total before deduction and tax</div>
                  </td>
                  <td colspan="2">  20</td>
                </tr>
                <tr>
                  <td colspan="2" class="text-end ">
                    <div class="text-center spechial-text">{{ __('site.value_added_tax') }}</div>
                    <div class="text-center spechial-text">value added tax</div>
                  </td>
                  <td colspan="2"> 2</td>
                </tr>
                <tr>
                  <td colspan="2" class="text-end ">
                    <div class="text-center spechial-text">{{ __('site.The_total_is_inclusive_of_tax') }}</div>
                    <div class="text-center spechial-text">Total including tax</div>
                  </td>
                  <td colspan="2"> 22</td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr class="my-4">
          <div class="text_area_holder mb-5">
            <div class="w-100">
              <textarea class="form-control area-con" placeholder="التعليمات هنا تكون" style="height: 80px"></textarea>
            </div>
          </div>
          <div class="bar_code_holder text-center">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="125" height="125" viewBox="0 0 125 125"><rect x="0" y="0" width="125" height="125" fill="#ffffff"></rect><g transform="scale(3.378)"><g transform="translate(0,0)"><path fill-rule="evenodd" d="M9 0L9 1L10 1L10 2L8 2L8 3L9 3L9 4L10 4L10 5L9 5L9 6L8 6L8 8L4 8L4 9L8 9L8 10L6 10L6 11L5 11L5 10L3 10L3 8L0 8L0 9L1 9L1 10L0 10L0 11L1 11L1 10L3 10L3 11L2 11L2 15L1 15L1 14L0 14L0 16L2 16L2 17L0 17L0 18L3 18L3 19L2 19L2 21L1 21L1 19L0 19L0 21L1 21L1 22L0 22L0 23L1 23L1 24L0 24L0 25L1 25L1 26L0 26L0 27L1 27L1 28L0 28L0 29L1 29L1 28L2 28L2 29L5 29L5 28L6 28L6 29L7 29L7 28L6 28L6 27L7 27L7 26L8 26L8 22L6 22L6 21L9 21L9 22L10 22L10 23L12 23L12 24L10 24L10 25L9 25L9 26L10 26L10 25L11 25L11 26L12 26L12 24L14 24L14 26L13 26L13 27L14 27L14 26L16 26L16 25L17 25L17 24L18 24L18 23L19 23L19 22L17 22L17 21L18 21L18 20L19 20L19 18L22 18L22 19L20 19L20 20L21 20L21 21L20 21L20 22L21 22L21 23L20 23L20 24L19 24L19 25L20 25L20 27L21 27L21 29L20 29L20 28L19 28L19 26L18 26L18 27L17 27L17 29L16 29L16 27L15 27L15 29L16 29L16 30L17 30L17 29L18 29L18 31L15 31L15 30L14 30L14 29L13 29L13 28L12 28L12 27L10 27L10 30L11 30L11 31L12 31L12 32L11 32L11 34L12 34L12 32L14 32L14 34L13 34L13 35L14 35L14 34L17 34L17 36L18 36L18 35L19 35L19 37L20 37L20 35L21 35L21 37L22 37L22 36L24 36L24 35L23 35L23 34L25 34L25 32L26 32L26 31L27 31L27 29L26 29L26 28L28 28L28 33L31 33L31 35L30 35L30 34L29 34L29 36L28 36L28 34L27 34L27 35L25 35L25 36L27 36L27 37L29 37L29 36L30 36L30 37L31 37L31 36L32 36L32 35L33 35L33 34L35 34L35 37L37 37L37 36L36 36L36 35L37 35L37 34L35 34L35 32L36 32L36 33L37 33L37 32L36 32L36 31L37 31L37 30L36 30L36 29L37 29L37 28L36 28L36 29L34 29L34 30L33 30L33 28L34 28L34 26L35 26L35 27L37 27L37 26L35 26L35 24L34 24L34 25L33 25L33 27L32 27L32 28L29 28L29 27L31 27L31 26L30 26L30 25L31 25L31 23L32 23L32 24L33 24L33 22L34 22L34 18L35 18L35 20L37 20L37 18L35 18L35 16L34 16L34 17L33 17L33 19L32 19L32 15L31 15L31 14L30 14L30 13L31 13L31 12L32 12L32 13L33 13L33 11L32 11L32 10L31 10L31 8L29 8L29 5L28 5L28 4L29 4L29 2L28 2L28 1L27 1L27 0L23 0L23 2L22 2L22 1L21 1L21 2L20 2L20 1L19 1L19 0L16 0L16 1L14 1L14 0L12 0L12 1L10 1L10 0ZM13 1L13 2L14 2L14 1ZM11 2L11 3L12 3L12 4L11 4L11 5L10 5L10 6L9 6L9 7L10 7L10 6L11 6L11 8L12 8L12 10L8 10L8 11L6 11L6 12L5 12L5 11L4 11L4 12L5 12L5 13L6 13L6 14L7 14L7 15L5 15L5 14L4 14L4 13L3 13L3 14L4 14L4 15L5 15L5 16L4 16L4 17L5 17L5 18L4 18L4 19L3 19L3 21L2 21L2 22L3 22L3 23L2 23L2 24L4 24L4 23L5 23L5 21L6 21L6 20L7 20L7 19L5 19L5 18L7 18L7 17L5 17L5 16L8 16L8 17L9 17L9 16L8 16L8 14L9 14L9 15L11 15L11 16L12 16L12 18L9 18L9 19L12 19L12 20L11 20L11 21L10 21L10 22L11 22L11 21L12 21L12 20L13 20L13 21L14 21L14 22L13 22L13 23L14 23L14 22L15 22L15 21L16 21L16 20L17 20L17 19L18 19L18 18L19 18L19 16L16 16L16 15L15 15L15 16L16 16L16 18L14 18L14 16L12 16L12 15L11 15L11 14L10 14L10 13L8 13L8 11L12 11L12 12L11 12L11 13L12 13L12 12L13 12L13 13L14 13L14 14L13 14L13 15L14 15L14 14L15 14L15 13L16 13L16 12L17 12L17 13L18 13L18 14L17 14L17 15L21 15L21 14L19 14L19 13L22 13L22 14L23 14L23 15L24 15L24 16L23 16L23 17L24 17L24 16L25 16L25 19L24 19L24 18L23 18L23 19L22 19L22 21L23 21L23 22L22 22L22 23L26 23L26 24L25 24L25 25L26 25L26 26L23 26L23 24L21 24L21 26L22 26L22 29L21 29L21 30L20 30L20 29L19 29L19 28L18 28L18 29L19 29L19 31L22 31L22 32L21 32L21 33L23 33L23 31L26 31L26 29L25 29L25 28L23 28L23 27L28 27L28 26L27 26L27 25L28 25L28 24L27 24L27 23L31 23L31 22L33 22L33 21L32 21L32 20L31 20L31 19L30 19L30 20L31 20L31 22L30 22L30 21L29 21L29 19L28 19L28 18L27 18L27 15L29 15L29 16L30 16L30 14L27 14L27 15L26 15L26 13L29 13L29 12L30 12L30 11L31 11L31 10L29 10L29 12L26 12L26 13L25 13L25 11L28 11L28 10L27 10L27 9L28 9L28 8L27 8L27 7L28 7L28 6L27 6L27 7L26 7L26 6L25 6L25 7L26 7L26 8L25 8L25 9L26 9L26 10L23 10L23 7L24 7L24 6L23 6L23 4L24 4L24 5L27 5L27 4L28 4L28 2L25 2L25 3L24 3L24 2L23 2L23 4L22 4L22 2L21 2L21 4L20 4L20 3L19 3L19 2L17 2L17 3L16 3L16 2L15 2L15 3L16 3L16 4L15 4L15 5L14 5L14 4L13 4L13 3L12 3L12 2ZM25 3L25 4L27 4L27 3ZM19 4L19 6L18 6L18 5L17 5L17 6L16 6L16 8L15 8L15 6L14 6L14 5L13 5L13 6L12 6L12 8L14 8L14 10L13 10L13 11L14 11L14 10L16 10L16 8L17 8L17 9L18 9L18 8L19 8L19 9L20 9L20 11L18 11L18 10L17 10L17 12L23 12L23 13L24 13L24 14L25 14L25 13L24 13L24 11L21 11L21 8L22 8L22 7L23 7L23 6L22 6L22 4L21 4L21 5L20 5L20 4ZM13 6L13 7L14 7L14 6ZM17 6L17 7L18 7L18 6ZM19 6L19 8L20 8L20 6ZM21 6L21 7L22 7L22 6ZM9 8L9 9L10 9L10 8ZM34 8L34 9L35 9L35 10L34 10L34 11L35 11L35 13L34 13L34 14L33 14L33 15L37 15L37 12L36 12L36 11L37 11L37 9L35 9L35 8ZM15 11L15 12L16 12L16 11ZM0 12L0 13L1 13L1 12ZM6 12L6 13L7 13L7 14L8 14L8 13L7 13L7 12ZM35 13L35 14L36 14L36 13ZM2 15L2 16L3 16L3 15ZM25 15L25 16L26 16L26 15ZM17 17L17 18L18 18L18 17ZM30 17L30 18L31 18L31 17ZM13 18L13 19L14 19L14 18ZM4 19L4 21L3 21L3 22L4 22L4 21L5 21L5 19ZM15 19L15 20L16 20L16 19ZM25 19L25 20L23 20L23 21L24 21L24 22L27 22L27 21L28 21L28 22L29 22L29 21L28 21L28 19ZM25 20L25 21L27 21L27 20ZM36 21L36 22L35 22L35 23L37 23L37 21ZM6 23L6 24L5 24L5 26L3 26L3 25L2 25L2 26L1 26L1 27L2 27L2 28L5 28L5 27L6 27L6 26L7 26L7 25L6 25L6 24L7 24L7 23ZM15 23L15 24L16 24L16 23ZM36 24L36 25L37 25L37 24ZM2 26L2 27L3 27L3 26ZM8 27L8 28L9 28L9 27ZM11 28L11 29L12 29L12 28ZM8 29L8 33L9 33L9 32L10 32L10 31L9 31L9 29ZM23 29L23 30L25 30L25 29ZM29 29L29 32L32 32L32 29ZM13 30L13 31L14 31L14 30ZM30 30L30 31L31 31L31 30ZM34 30L34 31L33 31L33 32L35 32L35 30ZM15 32L15 33L16 33L16 32ZM17 32L17 33L18 33L18 34L19 34L19 35L20 35L20 34L19 34L19 32ZM32 33L32 34L33 34L33 33ZM8 34L8 37L10 37L10 36L9 36L9 34ZM21 34L21 35L22 35L22 34ZM11 35L11 36L12 36L12 37L13 37L13 36L12 36L12 35ZM15 35L15 36L16 36L16 35ZM0 0L7 0L7 7L0 7ZM1 1L1 6L6 6L6 1ZM2 2L5 2L5 5L2 5ZM30 0L37 0L37 7L30 7ZM31 1L31 6L36 6L36 1ZM32 2L35 2L35 5L32 5ZM0 30L7 30L7 37L0 37ZM1 31L1 36L6 36L6 31ZM2 32L5 32L5 35L2 35Z" fill="#000000"></path></g></g></svg>

          </div>
        </div>

                @endsection
