## Shared edges are worth more

1. Two DSUs over nodes 1..n.
2. Type 3: useful if it merges in either DSU (apply to both).
3. Type 1 (Alice) and type 2 (Bob): useful if it merges in its own DSU.
4. If either DSU has more than one component, return −1. Else return `len(edges) − useful`.

n = 4 examples → 2, 0, −1.

Do not process typed edges before shared ones; a type-3 edge replaces two single-type edges.

Time: O(E · α(n))  
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
