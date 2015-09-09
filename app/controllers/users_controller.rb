class UsersController < ApplicationController
  before_filter :find_user, :except => [:index, :new, :create] 

  def index
    if logged_in?
    @users = User.find(:all, :order => "first_name")
    else
    redirect_to :controller => "sessions" , :action => "new"
    end
  end

  def show
    @user = User.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @user }
    end
  end

  def new
    @user = User.new
  end

  def create
  @user = User.new(params[:user])

     if @user.save
        # @current_user = @user
        # session[:user] = @user.id

        flash[:notice] = "Successfully Signed up"
	redirect_to :action => "show", :id => @user.id
     else
        render :action => "new"
     end
  end  

  def edit
    @user = User.find(params[:id])
  end

  def update
   @user = User.find(params[:id])

    respond_to do |format|
      if @user.update_attributes(params[:user])
        format.html { redirect_to(@user, :notice => 'User was successfully updated.') }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @user.errors, :status => :unprocessable_entity }
      end
    end
  end

  def destroy
    @user = User.find(params[:id])
    @user.destroy
      
    respond_to do |format|
      format.html { redirect_to(users_url) }
      format.xml  { head :ok }
    end
  end



  private

  def find_user
   @user = User.find(params[:id])
  end
end
