## A dislike is an edge between groups

1. Build an adjacency list from `dislikes` (undirected).
2. `color[i] = 0` for everyone. For each person `i` with color 0, set it to 1 and BFS:
   - For each neighbor `v` of `u`: if `color[v] == color[u]`, return false; if `color[v] == 0`, set `color[v] = −color[u]` and enqueue.
3. Return true.

Start a search from every uncolored person; the graph can have several components.

Union-find also works: for each person, union all the people they dislike together, and fail if any person ends up in the same set as someone they dislike.

Do not color greedily without propagating; a later edge can contradict an early choice. Do not search from person 1 only.

Time: O(n + m)  
Space: O(n + m)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
