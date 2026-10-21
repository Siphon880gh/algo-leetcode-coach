Design a system where users join with a set of owned file chunks and receive an id (assigned as the statement specifies, typically the smallest available, with ids of departed users reused), leave, and request a chunk. A request returns the sorted ids of users owning that chunk; if any exist, the requester then owns it too. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Three structures

1. `join(chunks)`: id = heap pop if any freed, else `next++`; add the id to each chunk's owner set.
2. `leave(id)`: remove the id from each of its chunks; push the id onto the freed heap.
3. `request(id, chunk)`: `owners = sorted(owners[chunk])`; if non-empty, add `id` to that chunk's owners. Return `owners`.

For instance, users 1 {1,2} and 2 {2}: request(1, 2) → [1, 2]. After user 1 leaves, the next join reuses id 1.

Do not reuse ids by scanning from 1 each time; use a heap. Do not forget to grant the chunk after a successful request.

Time: O(c log n) per join/leave, O(k log k) per request  
Space: O(users · chunks)

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
