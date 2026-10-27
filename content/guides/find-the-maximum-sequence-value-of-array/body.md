## Prefix and suffix sets

1. L[i] = ORs of k elements chosen from nums[0 … i] (layered by count, 128 values each).
2. R[i] = the same from nums[i …].
3. Answer: max x XOR y over x ∈ L[i], y ∈ R[i + 1].

Examples → 5, 2. Checked against every subsequence on 150 random arrays.

Using two contiguous blocks: example 2 → 1 instead of 2. About 400 · 200 · 128 ≈ 10^7 set updates.

Time: O(n · k · 128)  
Space: O(n · 128)

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
