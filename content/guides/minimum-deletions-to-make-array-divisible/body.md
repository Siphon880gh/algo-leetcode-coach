## gcd, then the smallest divisor

1. `g = gcd(numsDivide)`.
2. Sort `nums`. Return the first index `i` with `g mod nums[i] = 0`, or −1.

Examples → 2, −1. Checked against testing every element against every number on 300 random cases.

Deleting the first i elements of the sorted array removes every smaller value, including all copies of them, so `nums[i]` becomes the minimum. Without sorting, find the smallest valid value and count the elements below it.

Time: O(n log n + m log(max))  
Space: O(1) beyond sorting

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
