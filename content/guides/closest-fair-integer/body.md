An integer is fair when it has as many even digits as odd digits. Given a positive integer n, return the smallest fair integer that is at least n. For instance, 2 → 10, 403 → 1001 and 1234 → 1234. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Prefix, bump, fill

1. If n has an even number of digits and is fair, return n.
2. If it has even length L: for `i = L − 1 … 0` and each digit `d > n[i]`, take `n[0 … i − 1] + d` and fill the remaining positions with the needed evens as 0s, then the needed odds as 1s; the first that fits is the answer.
3. Otherwise return `1`, then m zeros, then m − 1 ones, with 2m the smallest even length above L.

Constructed checks (verified against counting up on every n to 10^6 and on 300 random 8-digit n): the cases above → 10, 1001, 1234; 99 → 1001; 99999999 → 1000001111.

Counting up one by one is simple but can take very long, for example from just above 10^8 to 1000001111. The last digits changed should be the smallest that still balance, which 0s then 1s are.

Time: O(L² · 10)  
Space: O(L)

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
