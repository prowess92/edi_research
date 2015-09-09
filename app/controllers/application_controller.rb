class ApplicationController < ActionController::Base
  helper :all

  protect_from_forgery
 
  before_filter :initialize_user, :except => [:login_check ]
  
  #check authenticity
  def login_check 
    if !logged_in?
    redirect_to :controller => "sessions" , :action => "new"
    end 
  end

  # make these available as ActionView helper methods.
  helper_method :logged_in?

  protected

  # Check if the user is already logged in
  def logged_in? 
    @current_user.is_a?(User)
  end
  
  # setup user info on each page
  def initialize_user
   
      @current_user = User.find_by_id(session[:user]) if session[:user]
    
  end

  
end

