## Tiny example

Iterative traversals:

- **BFS levels:** queue → `1 | 2,3 | …`
- **DFS preorder:** stack push right then left (so left pops first)
- In/post iterative need a state mark or two-stack tricks

Same orders as recursion, explicit structures instead of the call stack.


## How

1. BFS → queue
2. Preorder → stack with push order care
3. For in/post, use color marks (visit vs expand) if needed


## Trap

Using one stack exactly like recursion without storing “phase”, then wondering why postorder breaks.

**Fix:** Store a state bit/phase with each stacked node.

**Time:** O(n) · **Space:** O(n) worst width/depth

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
