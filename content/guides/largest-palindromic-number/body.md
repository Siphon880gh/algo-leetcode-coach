## Half, middle, mirror

1. `half` = digits 9 … 0, each repeated `cnt[d] / 2` times; strip leading zeros from `half`.
2. `mid` = the largest digit with an odd count, or empty.
3. Return `half + mid + reverse(half)`, or 0 if that is empty.

Examples → 7449447, 9. Checked against every palindrome from up to 6 digits on 200 random inputs; 00 → 0.

Longer wins, so use every pair, except that zeros cannot lead; if the only pairs are zeros, the half is empty and only the middle digit remains. A digit whose pair went into the half can still be the middle if its count is odd.

Time: O(n)  
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
