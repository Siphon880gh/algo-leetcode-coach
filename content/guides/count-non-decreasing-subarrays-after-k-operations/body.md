## Blocks of the running max

1. For l = n − 1 down to 0: merge front blocks with value ≤ nums[l] into one block of nums[l], adding (nums[l] − value) · count to the cost.
2. While cost > k: subtract (last block value − nums[r]), shrink the last block, r −= 1.
3. Add r − l + 1.

Examples → 17, 12. Checked against every subarray on 600 random cases.

Paying only for drops between neighbors: example 1 → 21 instead of 17.

Time: O(n) amortized  
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
