<?php
Yii::import('application.extensions.lib.*');
class GitHubClient extends CComponent
{
    private $gitHubClient;

    public function init()
    {
        $this->gitHubClient = new GitHubApi(new GitHubCurl());
        $this->gitHubClient->auth("d62e24eb1cb7238943e3c792830b5da04b1dfa0f", "", GitHubApi::AUTH_OAUTH);
    }

    public function getUser($name)
    {
        return $this->gitHubClient->get(
            '/users/:user',
            array('user' => $name)
        );
    }

    public function getRepositoryById($id)
    {
        return $this->gitHubClient->get(
            '/repositories/:id',
            array('id' => $id)
        );
    }

    public function getRepository($owner, $repo)
    {
        return $this->gitHubClient->get(
            '/repos/:owner/:repo',
            array('owner' => $owner, 'repo' => $repo)
        );
    }

    public function getRepositoryContributorsByRepoId($repoId)
    {
        return $this->gitHubClient->get(
            '/repositories/:id/contributors',
            array('id' => $repoId)
        );
    }

    public function getRepositoryContributors($owner, $repo)
    {
        return $this->gitHubClient->get(
            '/repos/:owner/:repo/contributors',
            array('owner' => $owner, 'repo' => $repo)
        );
    }

    public function searchRepositories($search)
    {
        return $this->gitHubClient->get(
            '/search/repositories?q=:search&sort=forks',
            array('search' => $search)
        );
    }

}