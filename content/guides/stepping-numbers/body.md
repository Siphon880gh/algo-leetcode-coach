A stepping number is an integer whose adjacent digits differ by exactly 1. Given `low` and `high`, return all stepping numbers in that range in increasing order. For instance, `low = 10, high = 15` gives `[10,12]`, and `low = 0, high = 21` gives `[0,1,…,9,10,12,21]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## BFS over last digits

1. If `low == 0`, start the answer with 0.
2. Queue `1..9`. Pop `x`; skip it if `x > high`; add it if `x ≥ low`.
3. With `d = x % 10`, push `x · 10 + d − 1` (if `d > 0`) and `x · 10 + d + 1` (if `d < 9`).

BFS goes by digit count, and within a level the numbers come out in increasing order, so the result is sorted.

Do not test every number in the range; the range can be huge while stepping numbers are rare. Do not seed the queue with 0; it would generate 01, 012, and so on. Use 64-bit integers, since `x · 10` can pass 32 bits.

Time: O(count of stepping numbers up to high)  
Space: O(same)

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
