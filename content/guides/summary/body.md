## Tiny example

Pick a structure for the hot operation:

| Need | Prefer |
|------|--------|
| `a[i]` often | Array / dynamic array |
| Head inserts / splices | Linked list |
| Many appends | Dynamic array (amortized) |
| Membership by key | Hash set/map |

Example: build a list by repeatedly `push_front` → linked list (or deque). Build by repeatedly `append` → dynamic array.


## How

1. Name the hottest operation
2. Match the layout
3. Re-evaluate if the hot op changes


## Trap

Defaulting to one structure for every problem.

**Fix:** Re-read the hot path; switch when the bottleneck changes.

**Time:** depends on the chosen layout’s hot op

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
