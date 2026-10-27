## Peel matching runs

1. `i = 0`, `j = n − 1`.
2. While `i < j` and `s[i] == s[j]`: let `c = s[i]`; advance `i` while `i ≤ j` and `s[i] == c`; retreat `j` while `j ≥ i` and `s[j] == c`.
3. Return `j − i + 1`.

`"ca"` → 2. `"cabaabac"` → 0. `"aabccabba"` → 3. Constructed: `"aba"` → 1 (the middle `b` cannot pair with itself).

The loop requires `i < j`, so a single middle character is never removed. The inner skips use `i ≤ j` so a block like `"aaa"` can vanish completely (prefix `"a"`, suffix `"aa"`).

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
