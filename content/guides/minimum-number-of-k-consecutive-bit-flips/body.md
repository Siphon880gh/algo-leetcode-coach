## The leftmost zero forces a flip

`flip = 0` (parity of active flips), `ends = [0] * (n + 1)`, `ans = 0`.

For each `i`:

1. `flip ^= ends[i]` (a flip that ends here stops affecting bits).
2. If `nums[i] ^ flip == 0`: this bit is 0.
   - If `i + k > n`, return −1 (no room for a flip).
   - `ans += 1`, `flip ^= 1`, `ends[i + k] ^= 1`.

Return `ans`.

Every window position is either flipped once or not at all (flipping twice cancels), and the order of flips does not matter. So decide left to right: at `i`, only the flip starting at `i` can still change bit `i`.

Do not actually flip k bits each time; that is O(n · k). Do not flip when the bit is already 1 after active flips.

Time: O(n)  
Space: O(n), or O(1) by marking flips in the input

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
