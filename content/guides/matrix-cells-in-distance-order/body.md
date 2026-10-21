## Counting sort on distance

1. Make `rows + cols − 1` empty buckets.
2. For every cell `(r, c)`, put it in bucket `|r − rCenter| + |c − cCenter|`.
3. Concatenate the buckets.

BFS from the center also produces this order, and sorting all cells by distance works in O(R · C · log(R · C)).

Do not use Euclidean distance; the problem asks for Manhattan distance. Within one distance, any order is accepted.

Time: O(R · C)  
Space: O(R · C)

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
