## Count appearances

1. `x1 = XOR of nums1`, `x2 = XOR of nums2`.
2. `answer = (x1 if len(nums2) is odd else 0) XOR (x2 if len(nums1) is odd else 0)`.
3. Return `answer`.

Examples → 13, 0. Checked against XOR-ing every pair on 300 random cases.

Building all pairs takes up to 10^10 steps. XOR is order-free and `x XOR x = 0`, so only the parity of each number’s count matters.

Time: O(n + m)  
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
