## Count differences

1. `d = [i : s1[i] ≠ s2[i]]`.
2. `len(d) == 0` → true.
3. `len(d) == 2` and `s1[d0] == s2[d1]` and `s1[d1] == s2[d0]` → true.
4. Else false.

`"bank", "kanb"` → true. `"attack", "defend"` → false. `"kelb", "kelb"` → true. Constructed: `"abc", "acd"` → false (two differences that do not cross-match).

One difference can never be fixed by a swap; three or more need more than one.

Time: O(n)  
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
