## Example first

nums = [1, 8, 1, 5, 1, 5, 8, 5].

| Value | Indices | Special |
|-------|---------|---------|
| 1 | 0, 2, 4 | yes, gaps 2 and 2 |
| 5 | 3, 5, 7 | yes, gaps 2 and 2 |
| 8 | 1, 6 | no, only twice |

Answer 2.

## Steps

1. Walk nums once and append each index to the list for its value.
2. A value is special when its list has exactly 3 indices and p0 + p2 = 2 · p1 (the middle index sits halfway).
3. Count those values.

## Trap

Allowing more than three copies. [8, 8, 8, 8] then counts 8, giving 1 instead of 0. Fix: the list length must be exactly 3.

Checked: the examples give 2, 0 and 0, and the grouping matched a direct check per value on 300 random arrays.

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
