## Each group keeps one stone

Removing stones in reverse DFS order (leaves first) always leaves a stone that shares a line with the one being removed, so a connected group of `k` stones loses `k − 1`.

Union-find over lines instead of stones:

1. For each stone `(r, c)`, union node `r` with node `c + 10001` (columns get their own id range).
2. Count the distinct roots among the lines that appear in some stone.
3. Return `n − components`.

Uniting a row with a column links every stone on that row with every stone on that column, without comparing stone pairs.

Do not compare every pair of stones unless n is small; that is O(n²). Do not mix row and column ids; row 3 and column 3 are different lines.

Time: O(n α(n))  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
