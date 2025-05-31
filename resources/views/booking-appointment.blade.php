@extends('layouts.app')

@section('content')
<style>
   /* Preview Section Styles */
            label{
                display:unset !important;
            }
            .swal2-checkbox{
                display:none !important;
            }
        .preview-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .preview-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

        .preview-item p {
            margin: 5px 0;
            font-size: 16px;
        }

        .preview-item strong {
            color: #2c3e50;
        }

        /* Estimate Section */
        .estimate {
            font-size: 20px;
            font-weight: 600;
            color: #27ae60;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Buttons Styles */
        .button-container {
            text-align: center;
        }

        .rr-about-3-thumb-booking {
            position: relative;
            border: 30px solid var(--rr-theme-1);
            z-index: 2;
         }
</style>
<main>

     
      <!-- Appointment area start -->
      <section class="rr-Appointment-area p-relative pb-30 fix">
         <div class="container">
            <div class="row">
               <div class="rr-appointment-wrapp">
                  <div class="rr-section-title-wrapper mb-40">
                     <span class="rr-section-subtitle wow rrfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s" style="visibility: visible; animation-duration: 0.9s; animation-delay: 0.5s; animation-name: rrfadeLeft;">Appointment</span>
                     <h3 class="rr-section-title wow rrfadeRight" data-wow-duration=".9s" data-wow-delay=".7s" style="visibility: visible; animation-duration: 0.9s; animation-delay: 0.7s; animation-name: rrfadeRight;">Enter your booking details</h3>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 wow rrfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s" style="visibility: visible; animation-duration: 0.9s; animation-delay: 0.5s; animation-name: rrfadeLeft;">
                  <div class="rr-about-3-thumb-booking">
                     <img src="{{ asset('assets/img/about/img-sm.jpg') }}" alt="">
                  </div>
               </div>
               <div class="col-xl-8 col-lg-8 col-md-8" style="background:#B2C1B4;padding: 30px;"> <!-- #F5F5F5-->
                  <div class="rr-appointment-info ml-15">
                     <div class="rr-contact-2__comment-form-box">
                        <div class="rr-contact-2__comment-form text-center wow rrfadeUp" data-wow-duration=".9s"
                           data-wow-delay=".5s">
                            <!-- The Form -->
                           <form id="contact-us__formss" method="POST" action="book-appointment" class="rr-contact-2-main mb-40">
                              <div class="row wow fadeInLeft animated" data-wow-delay=".9s">
                                 <!-- First Name -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">First Name <span class="text-red">*</span></label>
                                          <input name="firstname" id="firstname" class="form-control" type="text" placeholder="Your First Name" value="{{ Auth::user()->name }}">
                                       </div>
                                 </div>

                                 <!-- Last Name -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Last Name <span class="text-red">*</span></label>
                                          <input name="lastname" id="lastname" class="form-control" type="text" placeholder="Your Last Name" value="{{ @$bookingData->lastname }}">
                                       </div>
                                 </div>

                                 <!-- Email -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Your Email <span class="text-red">*</span></label>
                                          <input name="email" id="email" type="text" class="form-control" placeholder="Your Email" value="{{ Auth::user()->email }}">
                                       </div>
                                 </div>

                                 <!-- Phone Number -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Phone Number <span class="text-red">*</span></label>
                                          <input name="phone" id="phone" type="text" class="form-control" placeholder="Phone Number" value="{{ @$bookingData->phone }}">
                                       </div>
                                 </div>

                                 <!-- Type of Event -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Type of Event <span class="text-red">*</span></label>
                                          <select name="wedding_type" id="wedding_type" class="form-control">
                                                <option value="">Type of Event</option>
                                                <option value="Wedding" {{ @$bookingData->wedding_type == 'Wedding' ? 'selected' : '' }}>Wedding</option>
                                                <option value="Corporate Meeting" {{ @$bookingData->wedding_type == 'Corporate Meeting' ? 'selected' : '' }}>Corporate Meeting</option>
                                                <option value="Conference" {{ @$bookingData->wedding_type == 'Conference' ? 'selected' : '' }}>Conference</option>
                                                <option value="Workshop" {{ @$bookingData->wedding_type == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                                <option value="Birthday Party" {{ @$bookingData->wedding_type == 'Birthday Party' ? 'selected' : '' }}>Birthday Party</option>
                                                <option value="Private Dinner" {{ @$bookingData->wedding_type == 'Private Dinner' ? 'selected' : '' }}>Private Dinner</option>
                                                <option value="Product Launch" {{ @$bookingData->wedding_type == 'Product Launch' ? 'selected' : '' }}>Product Launch</option>
                                                <option value="Charity Event" {{ @$bookingData->wedding_type == 'Charity Event' ? 'selected' : '' }}>Charity Event</option>
                                                <option value="Other Event Type" {{ @$bookingData->wedding_type == 'Other Event Type' ? 'selected' : '' }}>Other</option>
                                            </select>
                                       </div>
                                 </div>
                                 <!-- Hidden input for "Others" -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20" id="other_event_field" style="display:none;">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Other Event Type <span class="text-red">*</span></label>
                                          <input type="text" name="other_wedding_type" id="other_wedding_type" class="form-control" value="{{ @$bookingData->other_wedding_type }}">
                                       </div>
                                 </div>
                                 <!-- Number of Guests -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Number of Guests <span class="text-red">*</span></label>
                                          <select name="no_of_guest" id="no_of_guest" class="form-control">
                                             <option value="1-50"  {{ @$bookingData->no_of_guest == '1-50' ? 'selected' : '' }}>1-50</option>
                                             <option value="51-60"  {{ @$bookingData->no_of_guest == '51-60' ? 'selected' : '' }}>51-60</option>
                                             <option value="61-70"  {{ @$bookingData->no_of_guest == '61-70' ? 'selected' : '' }}>61-70</option>
                                             <option value="71-80"  {{ @$bookingData->no_of_guest == '71-80' ? 'selected' : '' }}>71-80</option>
                                             <option value="81-90"  {{ @$bookingData->no_of_guest == '81-90' ? 'selected' : '' }}>81-90</option>
                                             <option value="91-100"  {{ @$bookingData->no_of_guest == '91-100' ? 'selected' : '' }}>91-100</option>
                                             <option value="Others"  {{ @$bookingData->no_of_guest == 'Others' ? 'selected' : '' }}>Others</option>
                                          </select>
                                          <span style="color:red;font-size: 13px;">Seated (400 pax), come and go (500 pax)</span>
                                       </div>
                                 </div>

                                 <!-- Hidden input for "Others" -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20" id="other_guests_field" style="display:none;">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Please Specify Number of Guests <span class="text-red">*</span></label>
                                          <input type="number" name="other_no_of_guests" id="other_no_of_guests" class="form-control" value="{{ @$bookingData->other_no_of_guests }}">
                                       </div>
                                 </div>

                                 <!-- Event Date -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Event Date <span class="text-red">*</span></label>
                                          <input type="date" name="wedding_date" id="wedding-date" class="form-control" placeholder="Event Date"  value="{{ @$bookingData->wedding_date }}">
                                       </div>
                                 </div>

                                 <!-- Event Slot -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Event Slot <span class="text-red">*</span></label>
                                          <select name="event_slot" id="event_slot" class="form-control">
                                             <option value="">Event Slot</option>
                                             <option value="Slot 1 (8am - 1pm)" {{ @$bookingData->event_slot == 'Slot 1 (8am - 1pm)' ? 'selected' : '' }}>Slot 1 (8am - 1pm)</option>
                                             <option value="Slot 2 (6pm - 11pm)" {{ @$bookingData->event_slot == 'Slot 2 (6pm - 11pm)' ? 'selected' : '' }}>Slot 2 (6pm - 11pm)</option>
                                             <option value="Other timing - discuss later" {{ @$bookingData->event_slot == 'Other timing - discuss later' ? 'selected' : '' }}>Other timing - discuss later</option>
                                          </select>
                                       </div>
                                 </div>

                                 <!-- Seating Arrangement -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Seating Arrangement <span class="text-red">*</span></label>
                                          <select name="seating_arrangement" id="seating_arrangement" class="form-control">
                                             <option value="">Seating Arrangement</option>
                                             <option value="Banquet Style" {{ @$bookingData->seating_arrangement == 'Banquet Style' ? 'selected' : '' }}>Banquet Style - (weddings, gala dinners, private dinners, and charity events)</option>
                                             <option value="U-Shape"  {{ @$bookingData->seating_arrangement == 'U-Shape' ? 'selected' : '' }}>U-Shape – (corporate meetings, conferences, and workshops requiring discussions or presentations)</option>
                                             <option value="Boardroom"  {{ @$bookingData->seating_arrangement == 'Boardroom' ? 'selected' : '' }}>Boardroom (high-level corporate meetings, small workshops, or executive discussions)</option>
                                             <option value="Cocktail/Standing"  {{ @$bookingData->seating_arrangement == 'Cocktail/Standing' ? 'selected' : '' }}>Cocktail/Standing (social events, product launches, and birthday parties)</option>
                                             <option value="Cabaret Style"  {{ @$bookingData->seating_arrangement == 'Cabaret Style' ? 'selected' : '' }}>Cabaret Style (workshops, conferences, or casual corporate meetings requiring space for team discussions)</option>
                                             <option value="Custom"  {{ @$bookingData->seating_arrangement == 'Custom' ? 'selected' : '' }}>Custom (others)</option>
                                          </select>
                                       </div>
                                 </div>
                                 
                                 <!-- Hidden input for "Others" -->
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-20" id="other_seating_arrangement" style="display:none;">
                                       <div class="rr-contact-2-form-input-box">
                                          <label style="float:left;color:black !important;">Custom Seating Arrangement <span class="text-red">*</span></label>
                                          <input type="text" name="other_seating_arrangement" id="other_seating_arrangement" value="{{  @$bookingData->other_seating_arrangement }}" class="form-control">
                                       </div>
                                 </div>
                                <input type="hidden" name="booking_id" id="booking_id" value="{{  @$bookingData->booking_id }}" class="form-control">
                                 <!-- Audio/Visual Requirements -->
                                 <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box" style="text-align:left;">
                                          <label style="color:black !important;">Audio/Visual Requirements <span class="text-red">*</span></label>
                                          <div style="color:black !important;">
                                            
                                            @if(@$bookingData->booking_id)
                                                @php
                                                    $av_selected = explode(', ', @$bookingData->av_requirements);
                                                @endphp
                                                
                                                <input type="checkbox" name="av_requirements[]" value="2 Microphones" 
                                                    {{ in_array('2 Microphones', $av_selected) ? 'checked' : '' }}> 2 Microphones (FOC)<br>
                                                
                                                <input type="checkbox" name="av_requirements[]" value="Sound system (basic)" 
                                                    {{ in_array('Sound system (basic)', $av_selected) ? 'checked' : '' }}> Sound system (basic) (FOC)<br>
                                                
                                                <input type="checkbox" name="av_requirements[]" value="Stage lighting (basic)" 
                                                    {{ in_array('Stage lighting (basic)', $av_selected) ? 'checked' : '' }}> Stage lighting (basic) (FOC)<br>
                                                
                                                <input type="checkbox" name="av_requirements[]" value="Projector and Screen" 
                                                    {{ in_array('Projector and Screen', $av_selected) ? 'checked' : '' }}> Projector and Screen<br>
                                                
                                                <input type="checkbox" name="av_requirements[]" value="LED Screen" 
                                                    {{ in_array('LED Screen', $av_selected) ? 'checked' : '' }}> LED Screen<br>
                                                
                                                <input type="checkbox" name="av_requirements[]" value="Sound system (customized)" 
                                                    {{ in_array('Sound system (customized)', $av_selected) ? 'checked' : '' }}> Sound system (customized)<br>
                                                
                                                <input type="checkbox" name="av_requirements[]" value="Livestream/Video Conferencing Setup" 
                                                    {{ in_array('Livestream/Video Conferencing Setup', $av_selected) ? 'checked' : '' }}> Livestream/Video Conferencing Setup<br>
                                                
                                                <input type="checkbox" name="av_requirements[]" value="Other" 
                                                    {{ in_array('Other', $av_selected) ? 'checked' : '' }}> Other<br>
                                                    
                                               
                                           @else
                                           
                                           
                                           
                                             <input type="checkbox" name="av_requirements[]"  {{ @$bookingData->av_requirements == '2 Microphones' ? 'selected' : '2 Microphones' }}  value="2 Microphones"> 2 Microphones (FOC)<br>
                                             <input type="checkbox" name="av_requirements[]" value="Sound system (basic)" checked> Sound system (basic) (FOC)<br>
                                             <input type="checkbox" name="av_requirements[]" value="Stage lighting (basic)" checked> Stage lighting (basic) (FOC)<br>
                                             <input type="checkbox" name="av_requirements[]" value="Projector and Screen"> Projector and Screen <br>
                                             <input type="checkbox" name="av_requirements[]" value="LED Screen"> LED Screen <br>
                                             <input type="checkbox" name="av_requirements[]" value="Sound system (customized)"> Sound system (customized) <br>
                                             <input type="checkbox" name="av_requirements[]" value="Livestream/Video Conferencing Setup"> Livestream/Video Conferencing Setup <br>
                                             <input type="checkbox" name="av_requirements[]" value="Other"> Other <br>
                                        @endif
                                          </div>
                                       </div>
                                 </div>

                                 <!-- Special Requests -->

                                 <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-20">
                                       <div class="rr-contact-2-form-input-box" style="text-align:left;">
                                          <label style="color:black !important;">Special Requests or Additional Services <span class="text-red">*</span></label>
                                          <div style="color:black !important;">
                                              @if(@$bookingData->booking_id)
                                              
                                              @php
                                                    $special_selected = explode(', ', @$bookingData->special_requests);
                                                @endphp
                                                
                                                <input type="checkbox" name="special_requests[]" value="Onsite staff" 
                                                    {{ in_array('Onsite staff', $special_selected) ? 'checked' : '' }}> Onsite staff (FOC)<br>
                                                
                                                <input type="checkbox" name="special_requests[]" value="Built-in Decoration" 
                                                    {{ in_array('Built-in Decoration', $special_selected) ? 'checked' : '' }}> Built-in Decoration (FOC)<br>
                                                
                                                <input type="checkbox" name="special_requests[]" value="Valet Parking" 
                                                    {{ in_array('Valet Parking', $special_selected) ? 'checked' : '' }}> Valet Parking (FOC)<br>
                                                
                                                <input type="checkbox" name="special_requests[]" value="Additional Decoration Services" 
                                                    {{ in_array('Additional Decoration Services', $special_selected) ? 'checked' : '' }}> Additional Decoration Services<br>
                                                
                                                <input type="checkbox" name="special_requests[]" value="Photography" 
                                                    {{ in_array('Photography', $special_selected) ? 'checked' : '' }}> Photography<br>
                                                
                                                <input type="checkbox" name="special_requests[]" value="Videography" 
                                                    {{ in_array('Videography', $special_selected) ? 'checked' : '' }}> Videography<br>

                                              @else
                                                 <input type="checkbox" name="special_requests[]" value="Onsite staff" checked> Onsite staff (FOC)<br>
                                                 <input type="checkbox" name="special_requests[]" value="Built-in Decoration" checked> Built-in Decoration (FOC)<br>
                                                 <input type="checkbox" name="special_requests[]" value="Valet Parking" checked> Valet Parking (FOC)<br>
                                                 <input type="checkbox" name="special_requests[]" value="Additional Decoration Services"> Additional Decoration Services <br>
                                                 <input type="checkbox" name="special_requests[]" value="Photography"> Photography <br>
                                                 <input type="checkbox" name="special_requests[]" value="Videography"> Videography <br>
                                             @endif
                                          </div>
                                       </div>
                                 </div>


                                 <!-- Message -->
                                 <div class="col-xl-12 mb-20">
                                       <div class="rr-contact-2-form-input-box">
                                          <textarea name="textarea"   id="textarea" cols="30" rows="10" placeholder="Your Message">{{  @$bookingData->textarea }}</textarea>
                                       </div>
                                 </div>

                                 <div class="col-xl-12 mb-20 text-start">
                                       <button type="button" id="view-quotation" style="padding: 10px 15px;margin: 20px;" class="rr-btn-2 wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                                          <span>Save Booking Details <i class="fa-solid fa-arrow-right"></i></span>
                                       </button>
                                 </div>
                              </div>
                           </form>

                           <!-- Preview Section -->
                           <div id="preview-section"  style="display:none;">
                              <h3 style="margin-bottom: 5%;">Your Booking Details:</h3>
                              <div id="preview-details"></div>
                              <button id="submit-button-edit" class="rr-btn" style="padding: 10px 15px;margin: 20px;" type="button" form="contact-us__edit">Edit  (edit the booking details)</button>
                              <button id="submit-button-save" class="rr-btn" style="padding: 10px 15px;margin: 20px;" type="button" form="contact-us__formss">Save</button>
                              <a id="my-event" href="{{ route('my-events') }}" class="rr-btn-2" style="padding: 10px 15px;margin: 20px; display:none;" type="button" >My Event</a>
                             <!-- <button id="submit-button-visit" class="rr-btn-2" style="padding: 10px 15px;margin: 20px;" type="button" form="contact-us__formss">Confrim Visit</button>
                              <button id="submit-button-booking" class="rr-btn" style="padding: 10px 15px;margin: 20px;" type="button" form="contact-us__formss">Confrim Booking</button>-->
                           
                           </div>

                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Appointment area end -->
      <!-- rr-testimonial-single-single area start -->
      <!--<div class="rr-testimonial-single-area gray-bg fix pt-120">
         <div class="container p-relative">
            <div class="row gx-30">
               <div class="col-lg-12">
                  <div class="rr-section-title-wrapper mb-40 text-center">
                     <span class="rr-section-subtitle wow rrfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">Our
                        Testimonial</span>
                     <h3 class="rr-section-title wow rrfadeLeft" data-wow-duration=".9s" data-wow-delay=".7s">Feedback from Clients"</h3>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-8 offset-xl-2 col-lg-12 col-md-12 col-12 p-relative">
                  <div class="rr-testimonial-single-wrap">
                     <div class="rr-testimonial-single-info p-relative">
                        <div class="rr-testimonial-single-quate-icon  wow rrfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                           <span><img src="{{ asset('assets/img/testimonial/quate.png') }}" alt=""></span>
                        </div>
                        <div class="rr-testimonial-single-quate-icon-right  wow rrfadeRight" data-wow-duration=".9s" data-wow-delay=".7s">
                           <span><img src="{{ asset('assets/img/testimonial/quate-2.png') }}" alt=""></span>
                        </div>
                        <div class="rr-testimonial-item-active">
                           <div class="rr-testimonial-single-item text-center">
                              <p class=" wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">"As a satisfied customer of , I want to share my positive experience with others. <br/>
                                 Their software as a service platform has greatly improved the efficiency and <br/>
                                 productivity of our business operations. </p>
                              <div class="designation wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                                 <h3>Evan Lwis</h3>
                              </div>
                           </div>
                           <div class="rr-testimonial-single-item text-center">
                              <p class=" wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">"As a satisfied customer of , I want to share my positive experience with others. <br/>
                                 Their software as a service platform has greatly improved the efficiency and <br/>
                                 productivity of our business operations. </p>
                              <div class="designation wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                                 <h3>Evan Lwis</h3>
                              </div>
                           </div>
                           <div class="rr-testimonial-single-item text-center">
                              <p class=" wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">"As a satisfied customer of , I want to share my positive experience with others. <br/>
                                 Their software as a service platform has greatly improved the efficiency and <br/>
                                 productivity of our business operations. </p>
                              <div class="designation wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                                 <h3>Evan Lwis</h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>-->
      <!-- rr-testimonial-single-single area end -->
     <!-- brand area end -->
    <!-- <section class="rr-brand-area pb-120 fix">
      <div class="container">
         <div class="row gx-30">
            <div class="col-xl-4 col-lg-4 col-md-12 col-12">
               <div class="rr-brand-content mt-45">
                  <h4 class="rr-brand-title wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">Our Trusted Branding Partners</h4>
               </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-12 wow rrfadeUp" data-wow-duration=".9s" data-wow-delay=".9s">
               <div class="swiper-container rr-brand-active">
                  <div class="swiper-wrapper">
                     <div class="swiper-slide">
                        <div class="rr-brand-item text-end">
                           <img src="assets/img/brand/brand-1.png" alt="">
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="rr-brand-item text-end">
                           <img src="assets/img/brand/brand.png" alt="">
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="rr-brand-item text-end">
                           <img src="assets/img/brand/brand2.png" alt="">
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="rr-brand-item text-end">
                           <img src="assets/img/brand/brand4.png" alt="">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section> -->
   <!-- brand area end -->
   </main>
   


@endsection

@section('scripts')

   <script>
         // Wait for the DOM to fully load
         document.addEventListener('DOMContentLoaded', function() {
            // List of dates to disable (format: YYYY-MM-DD)

            const disabledDates = @json($bookingDates);  //['2025-01-04', '2023-01-10'];
            console.log(disabledDates);
            // Function to disable specific dates
            document.getElementById('wedding-date').addEventListener('input', function(e) {
                  const selectedDate = e.target.value;
                  if (disabledDates.includes(selectedDate)) {
                     Swal.fire({
                        title: 'Error!',
                        text: 'This date is already book event.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                     });
                     e.target.value = '';  // Clear the selected date if it's disabled
                  }
            });
         });
      </script>

   <script>
         // jQuery to show the input field when "Others" is selected
         document.getElementById('no_of_guest').addEventListener('change', function() {
            var otherField = document.getElementById('other_guests_field');
            if (this.value === 'Others') {
                  otherField.style.display = 'block'; // Show the input field
            } else {
                  otherField.style.display = 'none'; // Hide the input field
            }
         });
         
         // jQuery to show the input field when "Others" is selected
         document.getElementById('seating_arrangement').addEventListener('change', function() {
            var otherField = document.getElementById('other_seating_arrangement');
            if (this.value === 'Custom') {
                  otherField.style.display = 'block'; // Show the input field
            } else {
                  otherField.style.display = 'none'; // Hide the input field
            }
         });
         
         
         

         // jQuery to show the input field when "Others" is selected
         document.getElementById('wedding_type').addEventListener('change', function() {
            var otherField = document.getElementById('other_event_field');
            if (this.value === 'Other Event Type') {
                  otherField.style.display = 'block'; // Show the input field
            } else {
                  otherField.style.display = 'none'; // Hide the input field
            }
         });

         
      </script>



      <!-- JavaScript for Preview and Submit -->
      <script>
         // Email validation function
         function validateEmail(email) {
            const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return re.test(String(email).toLowerCase());
         }
         // When user clicks the "View Quotation" button
         document.getElementById('view-quotation').addEventListener('click', function () {
            // Collect form data
            const firstname = document.getElementById('firstname').value;
            const lastname = document.getElementById('lastname').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const weddingType = document.getElementById('wedding_type') ? document.getElementById('wedding_type').value : '';
            const otherweddingType = document.getElementById('other_wedding_type') ? document.getElementById('other_wedding_type').value : '';
            
            const noOfGuests = document.getElementById('no_of_guest') ? document.getElementById('no_of_guest').value : '';
            const otherSeatingArrangement = document.getElementById('other_seating_arrangement') ? document.getElementById('other_seating_arrangement').value : '';
            const otherNoOfGuests = document.getElementById('other_no_of_guests') ? document.getElementById('other_no_of_guests').value : '';
            const eventDate = document.getElementById('wedding-date').value;
            const eventSlot = document.getElementById('event_slot') ? document.getElementById('event_slot').value : '';
            const seatingArrangement = document.getElementById('seating_arrangement') ? document.getElementById('seating_arrangement').value : '';
            const avRequirements = Array.from(document.querySelectorAll('input[name="av_requirements[]"]:checked')).map(input => input.value).join(', ');
            const specialRequests = Array.from(document.querySelectorAll('select[name="special_requests[]"] option:checked')).map(option => option.value).join(', ');

            // Check if any required field is empty
            if (!firstname || !lastname || !email || !phone || !weddingType || !noOfGuests || !eventDate || !eventSlot || !seatingArrangement) {
                  Swal.fire({
                     title: 'Error!',
                     text: 'Please fill in all the required fields before proceeding.',
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return; // Prevent submission or preview
            }

            // You can also check for more specific validations like email format or phone number format if necessary
            // Example: if the email is in the wrong format, show an error
            if (!validateEmail(email)) {
                  Swal.fire({
                     title: 'Error!',
                     text: 'Please enter a valid email address.',
                     icon: 'error',
                     confirmButtonText: 'Ok'
                  });
                  return;
            }
            
            // Create preview HTML with three-column layout, excluding empty values
            const previewHtml = `
                  <div class="preview-container" >
                     <div class="preview-item">
                        ${renderField('First Name', firstname)}
                        ${renderField('Last Name', lastname)}
                        ${renderField('Email', email)}
                        ${renderField('Phone Number', phone)}
                     </div>
                     <div class="preview-item">
                        ${renderField('Type of Event', weddingType)}
                        ${renderField('Other Type of Event', otherweddingType)}
                        
                        ${renderField('Number of Guests', noOfGuests)}
                        ${renderField('Other Number of Guests', otherNoOfGuests)}
                        ${renderField('Event Date', eventDate)}
                     </div>
                     <div class="preview-item">
                        ${renderField('Event Slot', eventSlot)}
                        ${renderField('Seating Arrangement', seatingArrangement)}
                        ${renderField('Custom Seating Arrangement', otherSeatingArrangement)}
                        ${renderField('Audio/Visual Requirements', avRequirements)}
                        ${renderField('Special Requests', specialRequests)}
                     </div>
                  </div>
                  <div style="color: green;font-size: 20px;">Your quotation will be sent to your email, along with a link to access your event details.</div>
            `;
            // Show the preview section with the collected details
            document.getElementById('preview-details').innerHTML = previewHtml;
            document.getElementById('preview-section').style.display = 'block';
            document.getElementById('contact-us__formss').style.display = 'none';
         });
         // Helper function to conditionally render a field if it has a value
         function renderField(label, value) {
            if (value) {
                  return `<p><strong>${label}:</strong> ${value}</p>`;
            }
            return ''; // Return empty string if value is empty
         }
        
         

         // Show the "Other" input field if the user selects "Others" in the number of guests
         document.getElementById('no_of_guest').addEventListener('change', function () {
            const otherGuestsField = document.getElementById('other_guests_field');
            if (this.value === 'Others') {
                  otherGuestsField.style.display = 'block';
            } else {
                  otherGuestsField.style.display = 'none';
            }
         });
         
      </script>



<script>
    document.getElementById('submit-button-edit').addEventListener('click', function () {
            // Show the preview section with the collected details
            document.getElementById('preview-section').style.display = 'none';
            document.getElementById('contact-us__formss').style.display = 'block';
    });
    // Function to handle Save action
    document.getElementById('submit-button-save').addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to save the details?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Save!',
            cancelButtonText: 'No, Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
               $("#loading").show();
               const formData = new FormData(document.getElementById('contact-us__formss'));
                formData.append('wedding_status', 'Pending Visit');
                // Submit form using AJAX
                submitForm(formData);// Proceed with AJAX form submission
                
            }
        });
    });

    // Function to handle Confirm Visit action
   /* document.getElementById('submit-button-visit').addEventListener('click', function () {
        Swal.fire({
            title: 'Visit Date & Time',
            html: document.getElementById('visit-date-modal').innerHTML,
            focusConfirm: false,
            showCancelButton: true,
            preConfirm: () => {
                const visitDate = document.getElementById('visit_date').value;
                const visitTime = document.getElementById('visit_time').value;

                if (!visitDate || !visitTime) {
                    Swal.showValidationMessage('Please select both date and time');
                }
                return { visitDate, visitTime };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // If visit date/time is provided, append it and submit
                const visitDate = result.value.visitDate;
                const visitTime = result.value.visitTime;

                // Append to form data
                const formData = new FormData(document.getElementById('contact-us__formss'));
                formData.append('visit_date', visitDate);
                formData.append('visit_time', visitTime);

                // Submit form with AJAX
                submitForm(formData);
            }
        });
    });*/


    // Function to handle Confirm Visit action
    document.getElementById('submit-button-visit').addEventListener('click', function () {
        // Display a SweetAlert2 modal with input fields for visit date and time
        Swal.fire({
            title: 'Please Select Visit Date & Time',
            html: `
                <label for="visit_date">Visit Date:</label>
                <input type="date" id="visit_date" name="visit_date" class="swal2-input" required>
                <label for="visit_time">Visit Time:</label>
                <input type="time" id="visit_time" name="visit_time" class="swal2-input" required>
            `,
            focusConfirm: false,  // Prevent focus on the confirm button (allow focus on input fields)
            showCancelButton: true,
            confirmButtonText: 'Confirm Visit',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const visitDate = document.getElementById('visit_date').value;
                const visitTime = document.getElementById('visit_time').value;

                // Validation: check if both fields are filled
                if (!visitDate || !visitTime) {
                    Swal.showValidationMessage('Please select both visit date and time');
                }

                return { visitDate, visitTime };
            }
        }).then((result) => {
            if (result.isConfirmed) {
               $("#loading").show();
                // If visit date and time are provided, append them and submit
                const visitDate = result.value.visitDate;
                const visitTime = result.value.visitTime;

                // Get form data and append visit date and time
                const formData = new FormData(document.getElementById('contact-us__formss'));
                formData.append('visit_date', visitDate);
                formData.append('visit_time', visitTime);
                formData.append('wedding_status', 'Confirm Visit');
                // Submit form using AJAX
                submitForm(formData);
            }
        });
    });

    // Function to handle Confirm Booking action
    document.getElementById('submit-button-booking').addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to confirm the booking?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Confirm Booking!',
            cancelButtonText: 'No, Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
               $("#loading").show();
                const formData = new FormData(document.getElementById('contact-us__formss'));
                formData.append('wedding_status', 'Confirm Booking');
                // Submit form using AJAX
                submitForm(formData);
            }
        });
    });

    // Generic function to submit the form using AJAX
    function submitForm(formData = null) {

        // If formData is null, use the default form data
        if (!formData) {
            formData = new FormData(document.getElementById('contact-us__formss'));
        }
        // AJAX form submission
        fetch('{{ url("save-booking-form") }}', {
            method: 'POST',
            body: formData,
            headers: {
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
        })
        .then(response => response.json())
        .then(data => {
            // Handle success or error
            $("#loading").hide();
            if (data.success) {
               
               Swal.fire({
                  title: 'Success!',
                  text: 'Your form has been submitted.',
                  icon: 'success',
                  confirmButtonText: 'OK'
               }).then((result) => {
                  if (result.isConfirmed) {
                     $("my-event").show();
                     $("submit-button-save").hide();
                     $("submit-button-edit").hide();
                         window.location.href = "{{ url('my-events') }}";

                  }
               });
            } else {
                Swal.fire('Error!', 'There was an issue with the submission. Please try again.', 'error');
            }
        })
        .catch(error => {
            $("#loading").hide();
            Swal.fire('Error!', 'Something went wrong. Please try again.', 'error');
        });
    }
</script>
@endsection