## Enumerate k

1. For k = 1 … 60: `t = num1 − k · num2`.
2. If `popcount(t) ≤ k ≤ t`, return k.
3. Return −1.

Examples → 3, −1. Checked against a search over operation sequences on 150 random small cases.

Both bounds are needed: each power is at least 1, so k > t is impossible. Without `k ≤ t`, num1 = 1, num2 = 1 → 1 instead of −1. t can reach about 6 · 10^10, so use 64-bit.

Time: O(60)  
Space: O(1)

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
