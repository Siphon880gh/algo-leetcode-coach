## O(1) pieces per house

1. For each i, split j at the sorted points {1, i, x, y, n}. Handle each split point directly.
2. On an open piece (p, q), each of the three terms has slope +1 (its centre ≤ p) or −1 (centre ≥ q). Take the smallest increasing value vi and the smallest decreasing value vd at j = p + 1.
3. The increasing line is lower for the first ⌈(vd − vi) / 2⌉ positions (at least 0, at most the piece); the decreasing line after that. Each part is a run of consecutive distances: add +1 to it in a difference array over k.
4. Prefix-sum the difference array.

Examples → [6, 0, 0], [10, 8, 2, 0, 0], [6, 4, 2, 0]. Checked against BFS from every house for all n ≤ 15 and every x, y, and on 200 random cases up to n = 120.

A BFS per house is O(n²), about 10^10 at n = 10^5. Each entry stays small: at most four houses lie at one distance from a given house, so result[k] ≤ 4n.

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
