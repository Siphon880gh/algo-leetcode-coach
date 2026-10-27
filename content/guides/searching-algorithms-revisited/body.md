## Tiny example

Finding a value `x` in different structures:

| Structure | Search cost |
|-----------|-------------|
| Unsorted array | O(n) scan |
| Sorted array | O(log n) binary search |
| Hash set | expected O(1) |
| Balanced BST | O(log n) |

You **pay for preprocessing**, such as sorting or building a hash table or a tree, to make each query faster.

## How

1. Count how many queries you will make.
2. If there are many, invest in a structure.
3. If there is one query on unsorted data, a linear scan may be enough.

## Trap

Sorting n = 10⁷ items when you only needed one lookup. That wastes O(n log n).

**Fix:** Match the cost of building a structure to the number of queries.

**Time:** depends on the structure, as shown in the table

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
