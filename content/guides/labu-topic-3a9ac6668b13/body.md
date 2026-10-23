## Tiny example

Backtracking families share one template; choice lists differ:

| Family | Choice at a depth |
|--------|-------------------|
| Subsets | take / skip element i |
| Combinations | pick next number ≥ last |
| Permutations | pick any unused index |
| Partition | cut here / extend segment |
| Board search | try each cell / column |

Example: combinations of size 2 from `[1,2,3]` → `[1,2],[1,3],[2,3]` by only picking forward.


## How

1. Identify the family
2. Write the choice generator
3. Reuse choose→recurse→undo


## Trap

Using permutation unused[] logic for combinations and getting duplicates / wrong sizes.

**Fix:** Combinations enforce sorted order / start index to avoid dup orderings.

**Time:** family-dependent · **Space:** O(depth)

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
