## Capped contribution

1. For the maximum: left[i] = i − previous greater-or-equal index; right[i] = next strictly greater index − i. Same for the minimum with signs flipped.
2. Subarrays with nums[i] as the extreme and length ≤ k: Σ_{x=0}^{L−1} max(0, min(R, k − x)), an arithmetic sum in O(1).
3. Answer Σ nums[i] · (count as maximum + count as minimum).

Examples → 20, −6. Checked against every subarray on 400 random arrays.

Dropping the length cap: example 1 → 24 instead of 20.

Time: O(n)  
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
