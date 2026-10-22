## Suffix DP

1. n < 3 → empty string.
2. f(n, c, 3) = 0; f(n, c, r < 3) = ∞.
3. f(i, c, r) = min(f(i + 1, c, min(r + 1, 3)) + |s[i] − c|, and if r = 3: min over d of f(i + 1, d, 1) + |s[i] − d|). The min over d is shared by all c, so each i costs O(26 · 3).
4. Rebuild left to right: at each step choose the smallest letter whose total equals the optimum.

Examples → cccc, aaa, empty. Checked against every good caption on 250 random strings.

Breaking ties toward the larger letter: example 1 → dddd instead of cccc.

Time: O(26 · n)  
Space: O(26 · n)

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
