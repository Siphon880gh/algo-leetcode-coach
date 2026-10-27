## Backspaces affect what comes before

A `#` erases a character to its **left**, so read from the right where you already know how many to skip.

`next_valid(s, i)`: `skip = 0`. While `i ≥ 0`: if `s[i] == '#'`, `skip += 1`; else if `skip > 0`, `skip −= 1`; else return `i`. Then `i −= 1`. Return −1.

Main loop: `i, j = next_valid(s, len(s) − 1), next_valid(t, len(t) − 1)`. While both are ≥ 0: if `s[i] ≠ t[j]`, return false; move both to their next valid index. Return true if both reached −1.

**Stack version:** build each final string with a stack (push letters, pop on `#` if non-empty) and compare. O(n) space.

Do not scan from the left with a skip counter; you cannot know yet whether a character will be erased. Do not pop an empty stack on a leading `#`.

Time: O(n + m)  
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
