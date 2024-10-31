<footer>
   <div class="container">
      <div class="row">
         <div class="col-md-4">
             <div class="full">
                <div class="logo_footer">
                  <a href="#"><img logo-store width="150" src="{{ asset('images/logo-store2.png') }}" alt="#" /></a>
                </div>
                <div class="information_f">
                  <p><strong>ADDRESS:</strong> Tầng 4, toà Mai Linh Đông Đô, 499 Lương Thế Vinh, Mễ Trì, Nam Từ Liêm, Hà Nội.</p>
                  <p><strong>TELEPHONE:</strong> 038 293 7209</p>
                  <p><strong>EMAIL:</strong> hr@bekisoft.com</p>
                </div>
             </div>
         </div>
         <div class="col-md-8">
            <div class="row">
            <div class="col-md-7">
               <div class="row">
                  <div class="col-md-6">
               <div class="widget_menu">
                  <h3>Menu</h3>
                  <ul>
                     <li><a href="{{ route('site.index')}}">Home</a></li>
                     <li><a href="{{ route('site.about')}}">About</a></li>
                     <li><a href="{{ route('site.about')}}">Services</a></li>
                     <li><a href="{{ route('site.about')}}">Blog</a></li>
                     <li><a href="{{ route('site.contact')}}">Contact</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-6">
               <div class="widget_menu">
                  <h3>Account</h3>
                  <ul>
                     <li><a href="{{ route('profile.edit') }}">Account</a></li>
                     <li><a href="{{ route('cart.checkout') }}">Checkout</a></li>
                     <li><a href="{{ route('login') }}">Login</a></li>
                     <li><a href="{{ route('register') }}">Register</a></li>
                     <li><a href="{{ route('site.product') }}">Shopping</a></li>
                  </ul>
               </div>
            </div>
               </div>
            </div>
            <div class="col-md-5">
               <div class="widget_menu">
                  <h3>Newsletter</h3>
                  <div class="information_f">
                    <p>Subscribe by our newsletter and get update to trending product.</p>
                  </div>
                  <div class="form_sub">
                     <form>
                        <fieldset>
                           <div class="field">
                              <input type="email" placeholder="Enter Your Mail" name="email" />
                              <input type="submit" value="Subscribe" />
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
   class="fa fa-arrow-up"></i></a>
<!-- footer end -->
<div class="cpy_">
   <p class="mx-auto">© 2024 All Rights Reserved By <a href="https://bekisoft.com/">BekiSoft</a><br>

      Distributed By InternBekiSoft</a>

   </p>
</div>