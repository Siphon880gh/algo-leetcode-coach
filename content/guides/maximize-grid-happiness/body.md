## Broken-profile DP

1. State `(pos, profile, introverts left, extroverts left)`; `profile` holds the previous n cells.
2. Up neighbour = `profile[0]`; left neighbour = `profile[n − 1]` if not at column 0.
3. Options: leave empty, place introvert (+120, −30 per neighbour), place extrovert (+40, +20 per neighbour); each neighbour also changes by −30 (introvert) or +20 (extrovert).
4. Shift the profile and recurse; take the max.

`2 × 3`, 1 introvert, 2 extroverts → 240. `3 × 1`, 2, 1 → 260. `2 × 2`, 4, 0 → 240.

States: 25 · 3^5 · 7 · 7 ≈ 300k, each with 3 options. Do not try all placements directly.

Time: O(m · n · 3^n · I · E)  
Space: same

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
