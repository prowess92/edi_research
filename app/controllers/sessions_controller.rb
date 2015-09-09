class SessionsController < ApplicationController
  def new
  end
  
  def index
    redirect_to :controller => "sessions" , :action => "new"  
  end

  def show 
  reset_session
  redirect_to :controller => "sessions" , :action => "new"
  end

  def login_check 
     redirect_to :controller => "sessions" , :action => "new"
  end
 
  def create
    @current_user = User.authenticate(params[:email], params[:password])
    if @current_user
      session[:user] = @current_user.id
      redirect_to :controller => "dashboard" , :action => "index" ,
                  :id => @current_user.id
    else
      flash[:notice] = "No user was found with this email/password"
      render :action => 'new'
    end
  end

   def destroy
     reset_session
     flash[:notice] = "Logged out successfully"
     redirect_to :controller => "sessions" , :action => "new"
   end
end
