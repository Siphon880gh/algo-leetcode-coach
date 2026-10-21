## Multiply in k steps

A copy followed by `k − 1` pastes turns `m` letters into `m · k` in `k` operations. Every way to reach `n` is a chain of such multipliers whose product is `n`, costing their sum.

For `a, b ≥ 2`, `a + b ≤ a · b`, so splitting a factor into smaller ones never costs more. The cheapest chain uses the prime factors:

```text
ans = 0, d = 2
while n > 1:
    while n % d == 0: ans += d; n //= d
    d += 1
```

`n = 1` needs 0 steps. A DP `f[i] = min over divisors j of f[j] + i / j` gives the same answer in O(n √n).

Do not paste before copying; the clipboard starts empty. Do not answer `n` for every input; that is right only when `n` is prime.

Time: O(√n)  
Space: O(1)

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
