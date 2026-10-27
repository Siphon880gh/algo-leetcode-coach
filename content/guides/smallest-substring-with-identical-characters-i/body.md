## Flips needed for L

1. need(1) = min(mismatches with 0101…, mismatches with 1010…).
2. need(L ≥ 2) = Σ over runs of ⌊m / (L + 1)⌋.
3. Answer the smallest L with need(L) ≤ numOps.

Examples → 2, 1, 1. Checked against trying every set of flips on 400 random strings.

Using the run formula for L = 1 too: 0110, numOps = 1 → 1 instead of 2.

Time: O(n²), at most 10^6  
Space: O(1)

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
