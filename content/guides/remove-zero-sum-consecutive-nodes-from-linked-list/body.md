## Two passes over prefix sums

1. `dummy = Node(0, head)`.
2. Pass 1: walk from `dummy` with running `s`, setting `last[s] = node` (later nodes overwrite).
3. Pass 2: walk from `dummy` with running `s`, setting `node.next = last[s].next`.
4. Return `dummy.next`.

`[1,2,−3,3,1]` → `[3,1]`. `[1,2,3,−3,−2]` → `[1]`.

Jumping to the last node with the same sum skips the longest zero-sum run starting there in one step.

Do not forget the dummy; a run can start at the head. Do not delete runs one at a time with a single map; removed nodes leave stale entries.

Time: O(n)  
Space: O(n)

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
