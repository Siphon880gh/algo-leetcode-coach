## Multisets of digits

1. For each first half, build the palindrome; keep it if divisible by k.
2. Record its sorted digits once.
3. For each multiset c: n! / Π c_d! arrangements, minus (n − 1)! / ((c_0 − 1)! Π_{d≠0} c_d!) if c_0 > 0.

Examples → 27, 2, 2468. Checked against brute force for n ≤ 4 and every k.

Counting the palindromes themselves: example 1 → 10 instead of 27.

Time: O(10^⌈n/2⌉ · n)  
Space: O(10^⌈n/2⌉)

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
