@extends('site.master')
@section('title', 'HomePage')
@section('body')
    <main>
        <div class="container">
            <div class="heading_container heading_center mt-5">
                <h2>
                   Contact Us
                </h2>
            </div>
        </div>
        <div class="container-fluid contact py-5">
            <div class="container py-5">
                <div class="p-5 bg-contact round">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-content">Get in touch</h1>
                                <p class="detail-contact mb-4">We are committed to providing attentive support and assistance. Should you have any questions or feedbacks, please do not hesitate to contact us. Our team is dedicated to responding promptly and ensuring you have a positive experience.</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="h-100 round mb-5">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.9011928605696!2d105.78152807510428!3d20.996597480644656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x650f433062f3272b%3A0xc8198a797fd796e3!2sBekisoft%20JSC!5e0!3m2!1svi!2s!4v1729240201925!5m2!1svi!2s"
                                    width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form action="" class="form-content">
                                <input type="text" class="w-100 form-control round border-0 py-3 mb-4" placeholder="Your Name">
                                <input type="email" class="w-100 form-control round border-0 py-3 mb-4"
                                    placeholder="Enter Your Email">
                                <textarea class="w-100 form-control round border-0 mb-4" rows="5" cols="10" placeholder="Your Message"></textarea>
                                <button class="w-100 btn form-control round border-success bg-white text-content "
                                    type="submit">Submit</button>
                            </form>
                        </div>
                        <div class="col-lg-5 ">
                            <div class="d-flex p-4 round mb-4 contact-method">
                                <i class="fas fa-map-marker-alt text-content me-4"></i>
                                <div>
                                    <h4 class="ml-3">Address</h4>
                                    <p class="ml-3 mb-2">Tầng 4, toà Mai Linh Đông Đô, 499 Lương Thế Vinh, Mễ Trì, Nam Từ Liêm, Hà Nội.</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 round mb-4 contact-method">
                                <i class="fas fa-envelope text-content me-4"></i>
                                <div>
                                    <h4 class="ml-3">Mail Us</h4>
                                    <p class="ml-3 mb-2">hr@bekisoft.com</p>
                                </div>
                            </div>
                            <div class="d-flex p-4 round mb-4 contact-method">
                                <i class="fa fa-phone-alt text-content me-4"></i>
                                <div>
                                    <h4 class="ml-3">Telephone</h4>
                                    <p class="ml-3 mb-2">038 293 7209</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
        <!-- Back to Top -->



    </main>
@stop()
