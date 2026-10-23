## Two steps

1. cost[i] = Σ |a − median| for window i … i + x − 1, kept with a sliding median and the sums of each half.
2. dp[j][i] = min(dp[j][i − 1], dp[j − 1][i − x] + cost[i − x]).
3. Answer dp[k][n].

Examples → 8, 3. Checked against trying every set of k windows and every target value on 300 random arrays.

Using the rounded mean instead of the median: [0, 5, 1, −3, 4, −2, −4], x = 3, k = 1 → 6 instead of 5.

Time: O(n log x + k · n)  
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
