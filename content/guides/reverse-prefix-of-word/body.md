## One find, one reverse

1. `i = word.find(ch)`.
2. If `i < 0`, return `word`; else return `reverse(word[0 : i + 1]) + word[i + 1 :]`.

Examples → `"dcbaefd"`, `"zxyxxe"`, `"abcd"`.

In place, swap `word[l]` and `word[r]` with `l = 0`, `r = i` moving inward. Only the first occurrence matters.

Time: O(n)  
Space: O(n) for the new string

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
