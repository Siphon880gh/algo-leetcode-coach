## Tiny example

Every backtracking family uses the same template. What changes is the list of choices at each depth:

| Family | Choice at each depth |
|--------|----------------------|
| Subsets | take or skip element i |
| Combinations | pick a next number that is at least the last one |
| Permutations | pick any unused index |
| Partition | cut here, or extend the current segment |
| Board search | try each cell or column |

Example: the combinations of size 2 from `[1,2,3]` are `[1,2]`, `[1,3]` and `[2,3]`. You get exactly these by only picking forward.

## How

1. Identify the family.
2. Write the code that lists the choices.
3. Reuse the same loop: choose, recurse, then undo.

## Trap

Using the permutation approach (an `unused[]` array) for combinations. You get duplicates or the wrong sizes.

**Fix:** For combinations, keep a start index so the picks stay in sorted order. This avoids counting the same set in different orders.

**Time:** depends on the family · **Space:** O(depth)

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
