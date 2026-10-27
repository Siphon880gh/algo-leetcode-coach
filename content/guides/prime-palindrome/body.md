## Generate, do not scan

Scanning every number up to 2·10⁸ is too slow, so build palindromes directly.

1. If `8 ≤ n ≤ 11`, return 11 (the only even-length palindromic prime).
2. For `root` from 1 upward, let `t = str(root)` and `p = int(t + t[-2::-1])` (mirror without repeating the middle digit).
3. If `p ≥ n` and `p` is prime (trial division up to √p), return `p`.

For a fixed number of digits, increasing `root` gives increasing palindromes, and longer roots give longer palindromes, so the first hit is the smallest.

Why skip even lengths: the alternating digit sum of an even-length palindrome is 0, so 11 divides it.

Do not check every integer for both properties. Do not forget the small cases n ≤ 7, which the loop handles (roots 2, 3, 5, 7).

Time: about O(10⁴ · √p) in the worst case  
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
