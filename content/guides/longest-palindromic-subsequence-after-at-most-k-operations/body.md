## dp(i, j, c)

1. i > j → 0; i = j → 1.
2. dp(i, j, c) = max(dp(i + 1, j, c), dp(i, j − 1, c), and 2 + dp(i + 1, j − 1, c − t) when t = cost(s[i], s[j]) ≤ c).
3. Answer dp(0, n − 1, k).

Examples → 3, 6. Checked against trying every subsequence on 300 random strings.

Cost |a − b| without wrapping: example 2 → 3 instead of 6.

Time: O(n² · k)  
Space: O(n² · k)

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
