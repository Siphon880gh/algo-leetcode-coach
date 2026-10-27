## Smallest change

1. If `n == 1`, return `""`.
2. For `i` in `0 .. n / 2 − 1`: if `s[i] ≠ 'a'`, set it to `'a'` and return.
3. Otherwise set the last character to `'b'`.

`"abccba"` → `"aaccba"`. `"a"` → `""`. `"aba"` → `"abb"` (the middle `b` cannot help).

Do not change the middle character of an odd-length string; it stays a palindrome. Do not scan the right half; changes there make larger strings.

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
