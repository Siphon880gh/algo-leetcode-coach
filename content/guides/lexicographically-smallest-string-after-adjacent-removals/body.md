## Two tables

1. can[i][i] = true; for even lengths: can[i][j] if some k (i < k < j, k − i odd) has adjacent(s[i], s[k]), can[i + 1][k] and can[k + 1][j].
2. best[n] = ""; best[i] = min(s[i] + best[i + 1], best[j] for every j with can[i][j]).
3. Answer best[0].

Examples → a, "", zdce. Checked against searching every removal order on 500 random strings.

Removing pairs greedily with a stack: example 1 → c instead of a.

Time: O(n³)  
Space: O(n²)

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
