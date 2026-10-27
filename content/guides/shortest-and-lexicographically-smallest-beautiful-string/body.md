## Windows over the ones

1. o = positions of 1.
2. For each i: `t = s[o[i] … o[i + k − 1]]`; keep it if shorter, or equal length and smaller.
3. Return the kept string, or empty.

Examples → 11001, 11, empty. Checked against testing every substring on 500 random strings.

Compare strings on ties: keeping the first shortest gives 1101100001 with k = 3 → 1101 instead of 1011.

Time: O(n²) with comparisons (n ≤ 100)  
Space: O(n)

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
