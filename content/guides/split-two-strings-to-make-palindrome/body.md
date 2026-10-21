## Match the outside, test the middle

1. `check(a, b)`: `i = 0`, `j = n − 1`; while `i < j` and `a[i] == b[j]`, move both inward.
2. Return true if `a[i..j]` or `b[i..j]` is a palindrome.
3. Answer `check(a, b) or check(b, a)`.

`"x"`, `"y"` → true. `"xbdef"`, `"xecab"` → false. `"ulacfd"`, `"jizalu"` → true (`"ula" + "alu"`).

Matching greedily as far as possible is safe: a longer outer match only shrinks the middle. Do not try every split index with a full check (O(n²)).

Time: O(n)  
Space: O(1)

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
