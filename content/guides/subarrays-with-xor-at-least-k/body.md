Given an array of positive integers and a non-negative integer k, count the contiguous subarrays whose XOR of all elements is at least k. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count below k

1. Insert prefix 0; seen = 1.
2. For each prefix p: walk bits high to low; where k has a 1, every stored q matching p’s bit there gives p ^ q < k, so add that child’s count and follow the other child; where k has a 0, follow the matching child.
3. Add seen − (count below k); insert p.

Constructed checks (run in code): [5, 1, 4], k = 3 → 4; [1, 1, 1], k = 1 → 4; [2, 2], k = 0 → 3. Checked against every subarray on 1,000 random arrays. This assumes values fit in 31 bits.

Counting XOR > k instead of ≥ k: [3], k = 3 → 0 instead of 1.

Time: O(n · B)  
Space: O(n · B)

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
