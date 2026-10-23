## Tiny example

Find `x` in data:

| Structure | Search |
|-----------|--------|
| Unsorted array | O(n) scan |
| Sorted array | O(log n) binary |
| Hash set | expected O(1) |
| Balanced BST | O(log n) |

You **pay preprocessing** (sort, build hash, build tree) to speed queries.


## How

1. Count how many queries you will make
2. If many, invest in a structure
3. If one query on unsorted data, a linear scan may be enough


## Trap

Sorting for a single search on n=1e7 when you only needed one lookup — wasted O(n log n).

**Fix:** Match structure cost to query count.

**Time:** depends on structure — see table

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
