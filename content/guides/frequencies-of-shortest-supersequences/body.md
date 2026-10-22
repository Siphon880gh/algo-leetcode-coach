## Subsets of at most 16 letters

1. For each subset D of the letters: reject it if some word xx has x outside D.
2. Edges x → y for words xy with x, y both outside D; reject if they contain a cycle (topological sort).
3. Keep the valid D of the smallest size; each gives counts 2 for D, 1 for the other letters used, 0 elsewhere.

Examples → [[1, 2, …], [2, 1, …]], [[2, 0, 1, …]], [[2, 2, 2, …]]. Checked against listing every shortest supersequence on 150 random cases with up to 3 letters.

Doubling only letters from words like aa: example 1 → a single array with a and b once each, but ab does not contain ba.

Time: O(2^16 · (16 + words))  
Space: O(16 + words)

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
