## Tiny example

You need a **queue ADT** (FIFO). Physical layouts that can implement it:

- Ring buffer in an array
- Linked nodes with head/tail pointers
- Language `deque`

Logical ADT (what operations mean) ≠ physical layout (how memory is arranged).


## How

1. Name the ADT ops and complexities you need
2. Pick a layout that hits those costs
3. Do not confuse “list” the ADT with “linked list” the layout


## Trap

Saying “use a list” without saying whether you mean array-backed or linked — complexities differ.

**Fix:** Specify the layout when Big-O matters.

**Takeaway:** ADT vs implementation

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
