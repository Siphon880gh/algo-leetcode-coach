## Per-center greedy

1. For each node, collect its neighbours’ values.
2. For center `c`: sort descending; add up to `k` of them while they are positive; plus `vals[c]`.
3. Return the maximum over all centers.

Examples → 16, −5.

Zero edges is allowed, so a lone node counts, and the answer can be negative as in Example 2. Each edge adds two neighbour entries, so sorting all lists costs O(m log m). Sums stay below about 10^9, which fits in 32-bit.

Time: O(n + m log m)  
Space: O(n + m)

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
